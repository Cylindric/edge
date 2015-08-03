<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Inflector;

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
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
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
        $character = $this->Characters->get($id, [
            'contain' => ['Training']
        ]);

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
                    'skills.id = t.skill_id',
                    't.character_id' => $id]
            ])
            ->group('Skills.id')
            ->order('Skills.name');

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
            if ($this->Characters->save($character)) {
                $this->Flash->success(__('The character has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The character could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('character'));
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
        $character = $this->Characters->get($id, [
            'contain' => ['Training']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $character = $this->Characters->patchEntity($character, $this->request->data);
            if ($this->Characters->save($character)) {
                $this->Flash->success(__('The character has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The character could not be saved. Please, try again.'));
            }
        }

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
                    'skills.id = t.skill_id',
                    't.character_id' => $id]
            ])
            ->group('Skills.id')
            ->order('Skills.name');

        $this->set('character', $character);
        $this->set('skills', $skills);
        $this->set('_serialize', ['character']);
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

    public function edit_skills($id = null)
    {
        $character = $this->Characters->get($id, [
            'contain' => ['Training']
        ]);

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
                    'skills.id = t.skill_id',
                    't.character_id' => $id]
            ])
            ->group('Skills.id')
            ->order('Skills.name');

        $this->set('character', $character);
        $this->set('skills', $skills);
        $this->set('_serialize', ['skills']);
    }

    public function change_skill($char_id = null, $skill_id = null, $delta = 1)
    {
        $this->loadModel('Training');

        $response = ['result' => 'fail'];
        if (!is_null($char_id) && !is_null($skill_id)) {
            $delta = (int)$delta;
            $train = $this->Training
                ->find()
                ->where(['skill_id' => $skill_id])
                ->first();

            if ($train === null && $delta > 0) {
                // No skill trained yet, so create a new record
                $train = $this->Training->newEntity();
                $train->character_id = $char_id;
                $train->skill_id = $skill_id;
                $train->level = $delta;

                if ($this->Training->save($train)) {
                    $id = $train->id;
                }
            } else {
                if ($train->level <= abs($delta) && $delta <= 0) {
                    //delete
                    $result = $this->Training->delete($train);

                } else {
                    // Change the skill
                    $train->level += $delta;
                    $this->Training->save($train);
                }
            }
            $response = ['result' => 'success'];

        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function change_stat($char_id = null, $stat_code = null, $delta = 1)
    {
        $response = ['result' => 'fail', 'data' => null];

        $Char = $this->Characters->get($char_id);
        if (!is_null($char_id) && !is_null($stat_code)) {
            $delta = (int)$delta;

            $stat_code = 'stat_' . $stat_code;
            $value = $Char->$stat_code;

            if ($value <= abs($delta) && $delta <= 1) {
                // Cannot reduce to lower than one
                $response = ['result' => 'success', 'data' => $Char->$stat_code];
                $this->Flash->error(__('The Stat could not be reduced lower than one.'));
            } else {
                // Change the stat
                $Char->$stat_code += $delta;
                if ($this->Characters->save($Char)) {
                    $response = ['result' => 'success', 'data' => $Char->$stat_code];
                    $this->Flash->success(__('The Stat has been saved.'));
                } else {
                    $this->Flash->error(__('The Stat could not be saved. Please, try again.'));
                }
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }


}
