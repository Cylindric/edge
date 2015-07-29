<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Training Controller
 *
 * @property \App\Model\Table\TrainingTable $Training
 */
class TrainingController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characters', 'Skills']
        ];
        $this->set('training', $this->paginate($this->Training));
        $this->set('_serialize', ['training']);
    }

    /**
     * View method
     *
     * @param string|null $id Training id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $training = $this->Training->get($id, [
            'contain' => ['Characters', 'Skills']
        ]);
        $this->set('training', $training);
        $this->set('_serialize', ['training']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $training = $this->Training->newEntity();
        if ($this->request->is('post')) {
            $training = $this->Training->patchEntity($training, $this->request->data);
            if ($this->Training->save($training)) {
                $this->Flash->success(__('The training has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The training could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Training->Characters->find('list', ['limit' => 200]);
        $skills = $this->Training->Skills->find('list', ['limit' => 200]);
        $this->set(compact('training', 'characters', 'skills'));
        $this->set('_serialize', ['training']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Training id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $training = $this->Training->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $training = $this->Training->patchEntity($training, $this->request->data);
            if ($this->Training->save($training)) {
                $this->Flash->success(__('The training has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The training could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Training->Characters->find('list', ['limit' => 200]);
        $skills = $this->Training->Skills->find('list', ['limit' => 200]);
        $this->set(compact('training', 'characters', 'skills'));
        $this->set('_serialize', ['training']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Training id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $training = $this->Training->get($id);
        if ($this->Training->delete($training)) {
            $this->Flash->success(__('The training has been deleted.'));
        } else {
            $this->Flash->error(__('The training could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
