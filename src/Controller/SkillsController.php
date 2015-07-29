<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Skills Controller
 *
 * @property \App\Model\Table\SkillsTable $Skills
 */
class SkillsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characteristics']
        ];
        $this->set('skills', $this->paginate($this->Skills));
        $this->set('_serialize', ['skills']);
    }

    /**
     * View method
     *
     * @param string|null $id Skill id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $skill = $this->Skills->get($id, [
            'contain' => ['Characteristics', 'Training']
        ]);
        $this->set('skill', $skill);
        $this->set('_serialize', ['skill']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $skill = $this->Skills->newEntity();
        if ($this->request->is('post')) {
            $skill = $this->Skills->patchEntity($skill, $this->request->data);
            if ($this->Skills->save($skill)) {
                $this->Flash->success(__('The skill has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The skill could not be saved. Please, try again.'));
            }
        }
        $characteristics = $this->Skills->Characteristics->find('list', ['limit' => 200]);
        $this->set(compact('skill', 'characteristics'));
        $this->set('_serialize', ['skill']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Skill id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $skill = $this->Skills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $skill = $this->Skills->patchEntity($skill, $this->request->data);
            if ($this->Skills->save($skill)) {
                $this->Flash->success(__('The skill has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The skill could not be saved. Please, try again.'));
            }
        }
        $characteristics = $this->Skills->Characteristics->find('list', ['limit' => 200]);
        $this->set(compact('skill', 'characteristics'));
        $this->set('_serialize', ['skill']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Skill id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $skill = $this->Skills->get($id);
        if ($this->Skills->delete($skill)) {
            $this->Flash->success(__('The skill has been deleted.'));
        } else {
            $this->Flash->error(__('The skill could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
