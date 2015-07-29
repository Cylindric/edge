<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Growth Controller
 *
 * @property \App\Model\Table\GrowthTable $Growth
 */
class GrowthController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Characters', 'Characteristics']
        ];
        $this->set('growth', $this->paginate($this->Growth));
        $this->set('_serialize', ['growth']);
    }

    /**
     * View method
     *
     * @param string|null $id Growth id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $growth = $this->Growth->get($id, [
            'contain' => ['Characters', 'Characteristics']
        ]);
        $this->set('growth', $growth);
        $this->set('_serialize', ['growth']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $growth = $this->Growth->newEntity();
        if ($this->request->is('post')) {
            $growth = $this->Growth->patchEntity($growth, $this->request->data);
            if ($this->Growth->save($growth)) {
                $this->Flash->success(__('The growth has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The growth could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Growth->Characters->find('list', ['limit' => 200]);
        $characteristics = $this->Growth->Characteristics->find('list', ['limit' => 200]);
        $this->set(compact('growth', 'characters', 'characteristics'));
        $this->set('_serialize', ['growth']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Growth id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $growth = $this->Growth->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $growth = $this->Growth->patchEntity($growth, $this->request->data);
            if ($this->Growth->save($growth)) {
                $this->Flash->success(__('The growth has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The growth could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Growth->Characters->find('list', ['limit' => 200]);
        $characteristics = $this->Growth->Characteristics->find('list', ['limit' => 200]);
        $this->set(compact('growth', 'characters', 'characteristics'));
        $this->set('_serialize', ['growth']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Growth id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $growth = $this->Growth->get($id);
        if ($this->Growth->delete($growth)) {
            $this->Flash->success(__('The growth has been deleted.'));
        } else {
            $this->Flash->error(__('The growth could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
