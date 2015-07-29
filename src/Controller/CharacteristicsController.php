<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Characteristics Controller
 *
 * @property \App\Model\Table\CharacteristicsTable $Characteristics
 */
class CharacteristicsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('characteristics', $this->paginate($this->Characteristics));
        $this->set('_serialize', ['characteristics']);
    }

    /**
     * View method
     *
     * @param string|null $id Characteristic id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $characteristic = $this->Characteristics->get($id, [
            'contain' => ['Growth', 'Skills']
        ]);
        $this->set('characteristic', $characteristic);
        $this->set('_serialize', ['characteristic']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $characteristic = $this->Characteristics->newEntity();
        if ($this->request->is('post')) {
            $characteristic = $this->Characteristics->patchEntity($characteristic, $this->request->data);
            if ($this->Characteristics->save($characteristic)) {
                $this->Flash->success(__('The characteristic has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characteristic could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('characteristic'));
        $this->set('_serialize', ['characteristic']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Characteristic id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $characteristic = $this->Characteristics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $characteristic = $this->Characteristics->patchEntity($characteristic, $this->request->data);
            if ($this->Characteristics->save($characteristic)) {
                $this->Flash->success(__('The characteristic has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The characteristic could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('characteristic'));
        $this->set('_serialize', ['characteristic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Characteristic id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $characteristic = $this->Characteristics->get($id);
        if ($this->Characteristics->delete($characteristic)) {
            $this->Flash->success(__('The characteristic has been deleted.'));
        } else {
            $this->Flash->error(__('The characteristic could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
