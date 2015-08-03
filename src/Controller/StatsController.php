<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Stats Controller
 *
 * @property \App\Model\Table\StatsTable $Stats
 */
class StatsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('Stats', $this->paginate($this->Stats));
        $this->set('_serialize', ['Stats']);
    }

    /**
     * View method
     *
     * @param string|null $id Stat id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stat = $this->Stats->get($id, [
            'contain' => ['Growth', 'Skills']
        ]);
        $this->set('stat', $stat);
        $this->set('_serialize', ['stat']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stat = $this->Stats->newEntity();
        if ($this->request->is('post')) {
            $stat = $this->Stats->patchEntity($stat, $this->request->data);
            if ($this->Stats->save($stat)) {
                $this->Flash->success(__('The stat has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The stat could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('stat'));
        $this->set('_serialize', ['stat']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Stat id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Stat = $this->Stats->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $Stat = $this->Stats->patchEntity($Stat, $this->request->data);
            if ($this->Stats->save($Stat)) {
                $this->Flash->success(__('The Stat has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Stat could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('Stat'));
        $this->set('_serialize', ['Stat']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Stat id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $Stat = $this->Stats->get($id);
        if ($this->Stats->delete($Stat)) {
            $this->Flash->success(__('The Stat has been deleted.'));
        } else {
            $this->Flash->error(__('The Stat could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
