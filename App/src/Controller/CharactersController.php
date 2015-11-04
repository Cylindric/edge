<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;

class CharactersController extends AppController
{

    public function isAuthorized($user)
    {
        // Public actions
        if (in_array($this->request->action, [
            'add',
            'get_soak',
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
            'edit_skills',
            'edit_stats',
            'join_group',
        ])) {
            if ($this->request->is('post')) {
                if(array_key_exists('character_id', $this->request->data)) {
                    $character_id = $this->request->data['character_id'];
                } else {
                    $character_id = $this->request->data['id'];
                }
            } else {
                $character_id = (int)$this->request->params['pass'][0];
            }
            if ($this->Characters->isOwnedBy($character_id, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index()
    {
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

    public function view($id = null)
    {
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

    public function add()
    {
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

        $species = $this->Characters->Species->find('list', ['limit' => 200]);

        $this->set(compact('character', 'species'));
        $this->set('_serialize', ['character']);
    }

    public function edit($id = null)
    {
        $response = ['result' => 'fail', 'data' => null];

        $character = $this->Characters->get($id, [
            'contain' => ['Groups']
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
        $this->set('_serialize', ['response']);
    }

    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $response = ['result' => 'fail', 'data' => null];

        $character = $this->Characters->get($this->request->data['id']);

        if ($this->Characters->delete($character)) {
            $response['result'] = 'success';
            $response['data'] = sprintf('%s has been deleted.', $character->name);
        } else {
            throw new ForbiddenException('Could not delete user');
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }
    
    public function edit_stats($id = null)
    {
        $character = $this->Characters->get($id);

        $this->set('character', $character);
        $this->set('_serialize', ['character']);
    }

    public function edit_notes($id = null)
    {
        $character = $this->Characters->get($id, [
            'contain' => ['Notes' => ['sort' => ['Notes.created DESC']]],
        ]);

        $this->set('character', $character);
        $this->set('_serialize', ['character']);
    }

    public function edit_skills($id = null)
    {
        $character = $this->Characters->get($id, ['contain' => ['CharactersSkills']]);

        $this->loadModel('Skills');

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
                'level' => $skills->func()->sum('t.level'),
                'career' => $skills->func()->sum('t.career'),
            ])
            ->contain(['Stats'])
            ->group(['Skills.id', 'Stats.name', 'Stats.code'])
            ->order('Skills.name');

        $this->set('character', $character);
        $this->set('skills', $skills);
        $this->set('_serialize', ['skills']);
    }

    public function change_stat($char_id = null, $stat_code = null, $delta = 1)
    {
        $stat_code = 'stat_' . $stat_code;
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($stat_code)) {
            $delta = (int)$delta;
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

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function get_soak($id)
    {
        $Char = $this->Characters->get($id);

        $breakdown = $Char->totalSoakBreakdown;
        $response = ['result' => 'success', 'soak' => array_sum($breakdown), 'breakdown' => $breakdown];

        $this->set(compact('response', 'breakdown'));
        $this->set('_serialize', ['response']);
    }

    public function get_strain_threshold($id)
    {
        $Char = $this->Characters->get($id);

        $breakdown = $Char->totalStrainThresholdBreakdown;
        $response = ['result' => 'success', 'strain_threshold' => array_sum($breakdown), 'breakdown' => $breakdown];

        $this->set(compact('response', 'breakdown'));
        $this->set('_serialize', ['response']);
    }

    public function get_wound_threshold($id)
    {
        $Char = $this->Characters->get($id);

        $breakdown = $Char->totalWoundThresholdBreakdown;
        $response = ['result' => 'success', 'wound_threshold' => array_sum($breakdown), 'breakdown' => $breakdown];

        $this->set(compact('response', 'breakdown'));
        $this->set('_serialize', ['response']);
    }

    public function change_attribute($char_id = null, $attribute_code = null, $delta = 1)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($attribute_code)) {
            $delta = (int)$delta;
            $Char = $this->Characters->get($char_id);

            switch ($attribute_code) {
                case 'strain':
                    $Char->strain = max(0, $Char->strain + $delta);
                    $response['data'] = $Char->strain;
                    break;
                case 'soak':
                    // Note: Soak can go below zero, because this is used to arbitrarily modify calculated Soak.
                    $Char->soak = $Char->soak + $delta;
                    $response['data'] = $Char->totalSoak;
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
                    $response['data'] = $Char->wound_threshold;
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
        $this->set('_serialize', ['response']);
    }

    public function join_group($char_id)
    {
        $Char = $this->Characters->get($char_id, ['contain' => 'Groups']);

        $this->loadModel('Groups');
        $Groups = $this->Characters->Groups->find('list')->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $character = $this->Characters->patchEntity($Char, $this->request->data);
            if ($this->Characters->save($character)) {
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
