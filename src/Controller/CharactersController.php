<?php
namespace App\Controller;

use App\Controller\AppController;

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
            'contain' => ['Growth', 'Training']
        ]);

        $this->loadModel('Skills');
        $skills = $this->Skills->find();
        $skills->select([
            'id', 'Skills.name', 'Skills.characteristic_id', 'Skills.skilltype_id',
            'Characteristics.name', 'Characteristics.code',
            'level' => $skills->func()->sum('t.level')
        ])
            ->contain(['Characteristics'])
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
            'contain' => ['Growth', 'Training']
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
            'id', 'Skills.name', 'Skills.characteristic_id', 'Skills.skilltype_id',
            'Characteristics.name', 'Characteristics.code',
            'level' => $skills->func()->sum('t.level')
        ])
            ->contain(['Characteristics'])
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


    public function get_skills($id = null)
    {
        $character = $this->Characters->get($id, [
            'contain' => ['Growth', 'Training']
        ]);

        $this->loadModel('Skills');
        $skills = $this->Skills->find();
        $skills->select([
            'id', 'Skills.name', 'Skills.characteristic_id', 'Skills.skilltype_id',
            'Characteristics.name', 'Characteristics.code',
            'level' => $skills->func()->sum('t.level')
        ])
            ->contain(['Characteristics'])
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

    public function increase_skill($char_id = null, $skill_id = null)
    {
        $response = ['result' => 'fail'];
        if (!is_null($char_id) && !is_null($skill_id)) {

            // get the current skill value
            $character = $this->Characters->find()
                ->contain(['Training'])
                ;//->where(['id' => $char_id])
                ;//->andWhere(['Training.skill_id' => $skill_id]);

            debug($character);
            //$this->loadModel('Skills');
            //$skill = $this->Skills->get($skill_id);
            //$skill->patchEntity($skill, ['is_done' => 1]);
            //if ($skill->save($todo)) {
            $response = ['result' => 'success'];
            //}
        }
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }


}
