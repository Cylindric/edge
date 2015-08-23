<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Rpg\CalculatorFactory;
use Cake\Utility\Inflector;
use Cake\Core\Configure;

/**
 * Characters Controller
 *
 * @property \App\Model\Table\CharactersTable $Characters
 */
class CharactersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');

        $this->loadComponent('Slack', [
            'webhook_url' => Configure::read('Slack.webhook_url'),
            'enabled' => Configure::read('Slack.enabled')
        ]);
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['add', 'index'])) {
            return true;
        }

        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
            'edit',
            'delete',
            'edit_stats',
            'edit_notes',
            'edit_talents',
            'edit_skills',
            'edit_weapons',
            'drop_weapon',
            'toggle_weapon',
            'change_skill',
            'change_stat',
            'add_talent',
            'join_group',
            'remove_talent',
            'change_talent_rank',
            'toggle_career',
            'remove_note',
            'add_note'

        ])) {
            $characterId = (int)$this->request->params['pass'][0];
            if ($this->Characters->isOwnedBy($characterId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }


    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $options = [
            'contain' => ['Species', 'Users'],
        ];
        if (!$this->Auth->User('role') == 'admin') {
            $options['conditions'] = ['Characters.user_id' => $this->Auth->User('id')];
        }

        $this->paginate = $options;
        $this->set('characters', $this->paginate($this->Characters));
        $this->set('_serialize', ['characters']);
    }

    /**
     * View method
     *
     * @param string|null $id Character id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $query = $this->Characters
            ->find('all')
            ->contain(['Training', 'Talents'])
            ->where(['Characters.id' => $id]);

        $char_is_owned = $this->Characters->isOwnedBy($id, $this->Auth->User('id'));

        if ($char_is_owned) {
            $query->contain(['Notes' => ['sort' => ['Notes.created DESC']]]);
        } else {
            $query->contain(['Notes' => function ($q) {
                return $q->where(['Notes.private' => false])->sort(['Notes.created']);
            }]);
        }

        $character = $query->first();

        $this->loadModel('Skills');
        $skills = $this->Skills->find();
        $skills->select([
            'id', 'Skills.name', 'Skills.stat_id', 'Skills.skilltype_id',
            'Stats.name', 'Stats.code',
            'level' => $skills->func()->sum('t.level')
        ])
            ->contain(['Stats'])
            ->join([
                'table' => 'training',
                'alias' => 't',
                'type' => 'LEFT',
                'conditions' => [
                    'Skills.id = t.skill_id',
                    't.character_id' => $id]
            ])
            ->group(['Skills.id', 'Stats.name', 'Stats.code'])
            ->order('Skills.name');

        $this->set('canEdit', $this->Characters->isOwnedBy($character->id, $this->Auth->User('id')));
        $this->set('character', $character);
        $this->set('skills', $skills);
        $this->set('_serialize', ['character']);

    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $character = $this->Characters->newEntity();
        if ($this->request->is('post')) {
            $character = $this->Characters->patchEntity($character, $this->request->data);
            $character->user_id = $this->Auth->user('id');

            if ($this->Characters->save($character)) {
                // Get the new Character, with associations
                $character = $this->Characters->get($character->id, ['contain' => ['Species']]);

                // Setup new skills based on the Species rules
                $species = CalculatorFactory::getSpecies($character->species, $character);
                $species->applyCreationStats();
                $species->applyCreationSkills();

                // Announce
                $this->Slack->announceCharacterCreation($character);

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

    /**
     * Edit method
     *
     * @param string|null $id Character id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $response = ['result' => 'fail', 'data' => null];

        $character = $this->Characters->get($id, [
            'contain' => ['Training', 'Groups']
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

    /**
     * Delete method
     *
     * @param string|null $id Character id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $character = $this->Characters->get($id);

        if ($this->Characters->delete($character)) {
            $this->Flash->success(__('The character has been deleted.'));
        } else {
            $this->Flash->error(__('The character could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
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

    public function edit_talents($id = null)
    {
        $character = $this->Characters->get($id, [
            'contain' => ['Talents']
        ]);

        $this->set('character', $character);
        $this->set('_serialize', ['character']);
    }

    public function edit_skills($id = null)
    {
        $character = $this->Characters->get($id, [
            'contain' => ['Training']
        ]);

        $this->loadModel('Skills');

        $skills = $this->Skills
            ->find()
            ->contain([
                'Stats',
                'Training' => function ($q) use ($id) {
                    return $q->where(['Training.character_id' => $id]);
                }])
            ->order('Skills.name');

        $this->set('character', $character);
        $this->set('skills', $skills);
        $this->set('_serialize', ['skills']);
    }

    public function edit_weapons($id = null)
    {
        $character = $this->Characters->get($id, [
            'contain' => [
                'CharactersWeapons' => ['sort' => 'equipped DESC'],
                'CharactersWeapons.Weapons',
                'CharactersWeapons.Weapons.Skills',
                'CharactersWeapons.Weapons.Ranges']
        ]);
        $this->set('character', $character);
        $this->set('_serialize', ['character']);
    }

    public function add_weapon($char_id, $weapon_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($weapon_id)) {

            $Char = $this->Characters->get($char_id, [
                'contain' => ['Weapons']
            ]);

            $this->loadModel('Weapons');
            $W = $this->Weapons->get($weapon_id);

            if ($this->Characters->Weapons->link($Char, [$W])) {
                // Announce
                $this->Slack->announceCharacterEdit($Char);
                $response = ['result' => 'success', 'data' => $Char->weapons];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function toggle_weapon($char_id = null, $character_weapon_id = null)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($character_weapon_id)) {
            $Char = $this->Characters->get($char_id, [
                'contain' => ['CharactersWeapons' => ['conditions' => ['CharactersWeapons.id' => $character_weapon_id]]]]);

            if (count($Char->characters_weapons) == 0) {
                // Non-existent link, invalid operation
            } else {
                $t = $Char->characters_weapons[0];
                $t->equipped = !$t->equipped;

                $Char->dirty('characters_weapons', true);
                if ($this->Characters->save($Char)) {
                    $response = ['result' => 'success', 'data' => $t->equipped];
                }
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function drop_weapon($char_id, $link_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($link_id)) {
            $this->loadModel('CharactersWeapons');

            if ($this->CharactersWeapons->delete($this->CharactersWeapons->get($link_id))) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function change_weapon_qty($char_id = null, $join_id = null, $delta = 1)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($join_id)) {
            $delta = (int)$delta;
            $Char = $this->Characters->get($char_id);

            $this->loadModel('CharactersWeapons');
            $T = $this->CharactersWeapons->get($join_id);
            $T->quantity += $delta;
            if ($T->quantity < 1) {
                if ($this->CharactersWeapons->delete($T))
                {
                    // Announce
                    $this->Slack->announceCharacterEdit($Char);
                    $response = ['result' => 'success', 'data' => 0];
                }
            } else {
                if ($this->CharactersWeapons->save($T)) {
                    // Announce
                    $this->Slack->announceCharacterEdit($Char);
                    $response = ['result' => 'success', 'data' => $T->quantity];
                }
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function change_skill($char_id = null, $skill_id = null, $delta = 1)
    {
        $this->loadModel('Skills');
        $this->loadModel('Training');

        $Character = $this->Characters->get($char_id, [
            'contain' => ['Training']
        ]);

        $Skill = $this->Skills
            ->find()
            ->contain([
                'Stats',
                'Training' => function ($q) use ($char_id) {
                    return $q->where(['Training.character_id' => $char_id]);
                }])
            ->where(['Skills.id' => $skill_id])
            ->first();

        $response = [
            'result' => 'fail',
            'Skill' => $Skill
        ];


        if (!is_null($char_id) && !is_null($skill_id)) {
            $delta = (int)$delta;

            if (count($Skill->training) == 0) {
                if ($delta > 0) {
                    // No skill trained yet, so create a new record
                    $train = $this->Training->newEntity();
                    $train->character_id = $char_id;
                    $train->skill_id = $skill_id;
                    $train->level = $delta;
                    $Skill->training[] = $train;
                    $Skill->dirty('training', true);
                }
                if ($this->Skills->save($Skill)) {
                    $response['result'] = 'success';
                }
            } else {

                // Change the skill
                $Skill->training[0]->level += $delta;
                $Skill->dirty('training', true);

                if ($this->Skills->save($Skill)) {
                    $response['result'] = 'success';
                }
            }
        }

        // Announce
        if ($response['result'] == 'success')
            $this->Slack->announceCharacterEdit($Character);


        $response['Dice'] = $Skill->dice($Character);
        $response['Level'] = $Skill->level;

        $this->set('skill', $Skill);
        $this->set('response', $response);
        $this->set('_serialize', ['response']);
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

    public function change_status($char_id = null, $stat_code = null, $delta = 1)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($stat_code)) {
            $delta = (int)$delta;
            $Char = $this->Characters->get($char_id);

            switch ($stat_code) {
                case 'strain':
                    $Char->strain = max(0, $Char->strain + $delta);
                    $response['data'] = $Char->strain;
                    break;
                case 'soak':
                    $Char->soak = max(0, $Char->soak + $delta);
                    $response['data'] = $Char->soak;
                    break;
                case 'strain_threshold':
                    $Char->strain_threshold = $Char->strain_threshold + $delta;
                    $response['data'] = $Char->strain_threshold;
                    break;
                case 'wounds':
                    $Char->wounds = max(0, $Char->wounds + $delta);
                    $response['data'] = $Char->wounds;
                    break;
                case 'wound_threshold':
                    $Char->wound_threshold = $Char->wound_threshold + $delta;
                    $response['data'] = $Char->wound_threshold;
                    break;
            }

            // Change the stat
            if ($this->Characters->save($Char)) {
                // Announce
                $this->Slack->announceCharacterEdit($Char);
                $response['result'] = 'success';
            }

        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function add_talent($char_id, $talent_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($talent_id)) {

            $Char = $this->Characters->get($char_id, [
                'contain' => ['Talents']
            ]);

            $this->loadModel('Talents');
            $T = $this->Talents->get($talent_id);
            $T->_joinData = ['rank' => 1];

            if ($this->Characters->Talents->link($Char, [$T])) {
                // Announce
                $this->Slack->announceCharacterEdit($Char);
                $response = ['result' => 'success', 'data' => $Char->talents];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function remove_talent($char_id, $join_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($join_id)) {
            $Char = $this->Characters->get($char_id);

            $this->loadModel('CharactersTalents');
            $link = $this->CharactersTalents->get($join_id);
            if ($this->CharactersTalents->delete($link)) {
                // Announce
                $this->Slack->announceCharacterEdit($Char);
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function change_talent_rank($char_id = null, $join_id = null, $delta = 1)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($join_id)) {
            $delta = (int)$delta;
            $Char = $this->Characters->get($char_id);

            $this->loadModel('CharactersTalents');
            $T = $this->CharactersTalents->get($join_id, ['contain' => 'Talents']);
            if ($T->talent->ranked) {
                $T->rank += $delta;
                if ($T->rank < 1) {
                    $T->rank = 1;
                }
            }
            if ($this->CharactersTalents->save($T)) {
                // Announce
                $this->Slack->announceCharacterEdit($Char);
                $response = ['result' => 'success', 'data' => $T->rank];
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function toggle_career($char_id = null, $skill_id = null)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($skill_id)) {
            $Char = $this->Characters->get($char_id, [
                'contain' => ['Training' => ['conditions' => ['Training.skill_id' => $skill_id]]]]);

            $this->loadModel('Training');
            if (count($Char->training) == 0) {
                // No training in this Skill at all, create a new record to flag Career status in
                $t = $this->Training->newEntity();
                $t->skill_id = $skill_id;
                $t->career = true;
                $Char->training[] = $t;
                $Char->dirty('training', true);
                if ($this->Characters->save($Char)) {
                    $response = ['result' => 'success', 'data' => $t->career];
                }
            } else {
                $t = $Char->training[0];
                $t->career = !$t->career;

                $Char->dirty('training', true);
                if ($this->Characters->save($Char)) {
                    $response = ['result' => 'success', 'data' => $t->career];
                }
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function remove_note($char_id, $note_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($note_id)) {
            $this->loadModel('Notes');

            if ($this->Notes->delete($this->Notes->get($note_id))) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function add_note($char_id)
    {
        $Char = $this->Characters->get($char_id);

        $this->loadModel('Notes');
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {
            $note = $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Characters->Notes->link($Char, [$note]);
                $response = ['result' => 'success', 'data' => $note];
            } else {
                $response = ['result' => 'fail', 'data' => $note];
            }
        }

        $this->set('response', $response);
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
                // Announce
                //$this->Slack->announceCharacterGroupJoin($character);

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
