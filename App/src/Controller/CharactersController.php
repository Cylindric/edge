<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\MethodNotAllowedException;

class CharactersController extends AppController {

    public function isAuthorized($user) {
        // Public actions
        if (in_array($this->request->action, [
                    'create',
                    'get_soak',
                    'get_stats',
                    'get_strain_threshold',
                    'get_wound_threshold',
                    'index',
                    'view',
                ])) {
            return true;
        }

        // These actions require a valid Character Id that the user owns
        if (in_array($this->request->action, [
                    'change_attribute',
                    'change_stat',
                    'delete',
                    'edit',
                    'edit_notes',
                    'get_skills',
                    'edit_stats',
                    'join_group',
                ])) {
            if ($this->request->is('post')) {
                if (array_key_exists('character_id', $this->request->data)) {
                    $character_id = $this->request->data['character_id'];
                } else {
                    $character_id = $this->request->data['id'];
                }
            } else {
                $character_id = (int) $this->request->params['pass'][0];
            }
            if ($this->Characters->isOwnedBy($character_id, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $options = [
            'contain' => ['Species', 'Users'],
        ];
        if ($this->Auth->User('role') != 'admin') {
            $options['conditions'] = ['Characters.user_id' => $this->Auth->User('id')];
        }

        $this->paginate = $options;
        $this->set('characters', $this->paginate($this->Characters));
        $this->set('_serialize', ['characters']);
    }

    public function view($id = null) {
        $query = $this->Characters
                ->find('all')
                ->contain([
                    'Armour',
                    'Talents',
                    'Weapons',
                    'Weapons.Ranges',
                    'Weapons.Skills',
                ])
                ->where(['Characters.id' => $id]);

        $char_is_owned = $this->Characters->isOwnedBy($id, $this->Auth->User('id'));

        if ($char_is_owned) {
            $query->contain(['Notes' => ['sort' => ['Notes.created DESC']]]);
        } else {
            $query->contain(['Notes' => function ($q) {
                    return $q->where(['Notes.private' => false])->order(['Notes.created']);
                }]);
                }

                $character = $query->first();

                // Get all the skills
                $this->loadModel('Skills');
                $skills = $this->Skills->find();
                $skills->join([
                            'table' => 'characters_skills',
                            'alias' => 't',
                            'type' => 'LEFT',
                            'conditions' => [
                                'Skills.id = t.skill_id',
                                't.character_id' => $id]
                        ])
                        ->select([
                            'id', 'Skills.name', 'Skills.stat_id', 'Skills.skilltype_id',
                            'Stats.name', 'Stats.code',
                            'level' => $skills->func()->sum('t.level')
                        ])
                        ->contain(['Stats'])
                        ->group(['Skills.id', 'Stats.name', 'Stats.code'])
                        ->order('Skills.name');

                $this->set('canEdit', $this->Characters->isOwnedBy($character->id, $this->Auth->User('id')));
                $this->set('character', $character);
                $this->set('skills', $skills);
                $this->set('_serialize', ['character']);
            }

            public function create() {
                $character = $this->Characters->newEntity();
                if ($this->request->is('post')) {
                    $character = $this->Characters->patchEntity($character, $this->request->data);
                    $character->user_id = $this->Auth->user('id');

                    if ($this->Characters->save($character)) {
                        // Get the new Character, with associations
                        $character = $this->Characters->get($character->id, ['contain' => ['Species']]);
                        $this->Flash->success(__('The character has been saved.'));
                        return $this->redirect(['action' => 'edit', $character->id]);
                    } else {
                        $this->Flash->error(__('The character could not be saved. Please, try again.'));
                    }
                }

                $species = $this->Characters->Species->find('list')->order('name');
                $careers = $this->Characters->Careers->find('list')->order('name');
                $specialisations = $this->Characters->Specialisations->find('list')->order('name');

                $this->set(compact('character', 'species', 'careers', 'specialisations'));
                $this->set('_serialize', ['character']);
            }

            public function edit($id = null) {
                $response = ['result' => 'fail', 'data' => null];

                $character = $this->Characters->get($id, [
                    'contain' => ['CharactersGroups', 'CharactersGroups.Groups']
                ]);

                if ($this->request->is(['patch', 'post', 'put'])) {
                    $data = $this->request->data;
                    if (array_key_exists('pk', $this->request->data)) {
                        // X-Editable input
                        $data = [$data['name'] => $data['value']];
                    }
                    $character = $this->Characters->patchEntity($character, $data);
                    if ($this->Characters->save($character)) {
                        $response['result'] = 'success';
                        $response['data'] = $character;

                        // Announce
                        $this->Slack->announceCharacterEdit($character);
                    } else {
                        $response['message'] = $character->errors();
                        $this->Flash->error(__('The character could not be saved. Please, try again.'));
                    }
                }

                $this->set('character', $character);
                $this->set('response', $response);
                $this->set('_serialize', ['character', 'response']);
            }

            public function delete() {
                $this->request->allowMethod(['post', 'delete']);
                $response = ['result' => 'fail', 'data' => null];

                if ($this->request->is(['post', 'delete'])) {
                    $character_id = (int) $this->request->data['character_id'];

                    $character = $this->Characters->get($character_id);

                    if ($this->Characters->delete($character)) {
                        $response['result'] = 'success';
                        $response['data'] = sprintf('%s has been deleted.', $character->name);
                    } else {
                        throw new ForbiddenException('Could not delete user');
                    }
                }

                $this->set('response', $response);
                $this->set('_serialize', 'response');
            }

            public function edit_notes($id = null) {
                $character = $this->Characters->get($id, [
                    'contain' => ['Notes' => ['sort' => ['Notes.created DESC']]],
                ]);

                $this->set('character', $character);
                $this->set('_serialize', ['character']);
            }

            public function get_skills($id) {
                $character = $this->Characters->get($id, ['contain' => ['CharactersSkills']]);
                $skills = $character->all_skills;

                // Update the dice for each skill
                foreach ($skills as $skill) {
                    $skill->dice_details = $skill->dice($character);
                }

                $this->set('skills', $skills);
                $this->set('_serialize', ['skills']);
            }

            public function change_stat() {
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $char_id = $this->request->data['character_id'];
                    $stat_code = $this->request->data['stat_code'];
                    $delta = $this->request->data['delta'];

                    $stat_code = 'stat_' . $stat_code;
                    $response = ['result' => 'fail', 'data' => null];

                    if (!is_null($char_id) && !is_null($stat_code)) {
                        $delta = (int) $delta;
                        $Char = $this->Characters->get($char_id);

                        $new_value = $Char->$stat_code += $delta;
                        $new_value = max(0, $new_value); // Stats cannot go below zero.
                        // Change the stat
                        $Char->$stat_code = $new_value;
                        if ($this->Characters->save($Char)) {
                            // Announce
                            $this->Slack->announceCharacterEdit($Char);

                            $response = ['result' => 'success', 'data' => $Char->$stat_code];
                        } else {
                            $this->Flash->error(__('The Stat could not be saved. Please, try again.'));
                        }
                    }
                }

                $this->set(compact('response'));
                $this->set('_serialize', 'response');
            }

            public function get_stats($id) {
                $char = $this->Characters->get($id);
                $response = [
                    'soak' => $char->total_soak,
                    'soak_breakdown' => $char->total_soak_breakdown,
                    'strain' => $char->strain,
                    'strain_threshold' => $char->total_strain_threshold,
                    'strain_threshold_breakdown' => $char->total_strain_threshold_breakdown,
                    'wounds' => $char->wounds,
                    'wound_threshold' => $char->total_wound_threshold,
                    'wound_threshold_breakdown' => $char->total_wound_threshold_breakdown,
                    'defence_melee' => $char->defence_melee,
                    'defence_ranged' => $char->defence_ranged,
                    'stats' => [
                        'br' => ['name' => 'Brawn', 'value' => $char->stat_br],
                        'ag' => ['name' => 'Agility', 'value' => $char->stat_ag],
                        'int' => ['name' => 'Intellect', 'value' => $char->stat_int],
                        'cun' => ['name' => 'Cunning', 'value' => $char->stat_cun],
                        'will' => ['name' => 'Willpower', 'value' => $char->stat_will],
                        'pr' => ['name' => 'Presence', 'value' => $char->stat_pr],
                    ],
                ];
                $this->set(compact('response'));
                $this->set('_serialize', 'response');
            }

            public function get_soak($id) {
                $Char = $this->Characters->get($id);

                $breakdown = $Char->total_soak_breakdown;
                $response = ['result' => 'success', 'soak' => array_sum($breakdown), 'breakdown' => $breakdown];

                $this->set(compact('response', 'breakdown'));
                $this->set('_serialize', 'response');
            }

            public function get_strain_threshold($id) {
                $Char = $this->Characters->get($id);

                $breakdown = $Char->total_strain_threshold_breakdown;
                $response = ['result' => 'success', 'strain_threshold' => array_sum($breakdown), 'breakdown' => $breakdown];

                $this->set(compact('response', 'breakdown'));
                $this->set('_serialize', ['response']);
            }

            public function get_wound_threshold($id) {
                $Char = $this->Characters->get($id);

                $breakdown = $Char->total_wound_threshold_breakdown;
                $response = ['result' => 'success', 'wound_threshold' => array_sum($breakdown), 'breakdown' => $breakdown];

                $this->set(compact('response', 'breakdown'));
                $this->set('_serialize', ['response']);
            }

            public function change_attribute() {
                $response = ['result' => 'fail', 'data' => null];

                if ($this->request->is('post')) {
                    $char_id = $this->request->data['character_id'];
                    $attribute_code = $this->request->data['attribute_code'];
                    $delta = $this->request->data['delta'];
                }

                if (!is_null($char_id) && !is_null($attribute_code)) {
                    $delta = (int) $delta;
                    $Char = $this->Characters->get($char_id);

                    switch ($attribute_code) {
                        case 'strain':
                            $Char->strain = max(0, $Char->strain + $delta);
                            $response['data'] = $Char->strain;
                            break;
                        case 'soak':
                            // Note: Soak can go below zero, because this is used to arbitrarily modify calculated Soak.
                            $Char->soak = $Char->soak + $delta;
                            $response['data'] = $Char->total_soak;
                            break;
                        case 'strain_threshold':
                            $Char->strain_threshold = $Char->strain_threshold + $delta;
                            $response['data'] = $Char->total_strain_threshold;
                            break;
                        case 'wounds':
                            $Char->wounds = max(0, $Char->wounds + $delta);
                            $response['data'] = $Char->wounds;
                            break;
                        case 'wound_threshold':
                            $Char->wound_threshold = $Char->wound_threshold + $delta;
                            $response['data'] = $Char->total_wound_threshold;
                            break;
                        case 'defence_melee':
                            $Char->defence_melee = $Char->defence_melee + $delta;
                            $response['data'] = $Char->defence_melee;
                            break;
                        case 'defence_ranged':
                            $Char->defence_ranged = $Char->defence_ranged + $delta;
                            $response['data'] = $Char->defence_ranged;
                            break;
                    }

                    // Change the stat
                    if ($this->Characters->save($Char)) {
                        $this->Slack->announceCharacterEdit($Char);
                        $response['result'] = 'success';
                    }
                }

                $this->set(compact('response'));
                $this->set('_serialize', 'response');
            }

            public function update_bio() {
                $response = null;

                if ($this->request->is('post')) {
                    $id = (int) $this->request->data['character_id'];
                    $biography = $this->request->data['biography'];

                    $character = $this->Characters->get($id);
                    $character->biography = $biography;

                    if ($this->Characters->save($character)) {
                        $response = $character;
                    } else {
                        $this->response->statusCode(400);
                    }
                }

                $this->set(compact('response'));
                $this->set('_serialize', 'response');
            }

            public function join_group($char_id) {
                $Char = $this->Characters->get($char_id, ['contain' => 'CharactersGroups']);

                $this->loadModel('Groups');
                $Groups = $this->Characters->CharactersGroups->Groups->find('list')->toArray();

                if ($this->request->is(['patch', 'post', 'put'])) {
                    $cg = $this->Characters->CharactersGroups->newEntity();
                    $cg->character_id = $Char->id;
                    $cg->group_id = (int) $this->request->data['group_id'];
                    $Char->characters_groups[] = $cg;
                    $Char->dirty('characters_groups', true);

                    if ($this->Characters->save($Char)) {
                        $this->Flash->success(__('The character has been added to the group.'));
                        return $this->redirect(['action' => 'edit', $char_id]);
                    } else {
                        $this->Flash->error(__('The character could not be added to the group. Please, try again.'));
                    }
                }

                $this->set('character', $Char);
                $this->set('groups', $Groups);
            }

        }
        