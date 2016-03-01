<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Talents Controller
 *
 * @property \App\Model\Table\TalentsTable $Talents
 */
class TalentsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user) {
        if ($this->request->action === 'index') {
            return true;
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        if ($this->request->is('ajax')) {
            $term = trim($this->request->query('term'));
            if (!empty($term)) {
                $talents = $this->Talents
                        ->find('all')
                        ->select(['value' => 'id', 'label' => 'name'])
                        ->where(['name LIKE' => $term . '%']);
            } else {
                $talents = array();
            }
        } elseif ($this->request->is('json')) {
            $talents = $this->Talents->find('all')->contain("Sources");
        } else {
            $talents = $this->paginate($this->Talents->find()->contain('Sources'));
        }
        $this->set('talents', $talents);
        $this->set('_serialize', 'talents');
    }

    /**
     * View method
     *
     * @param string|null $id Talent id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $talent = $this->Talents->get($id, [
            'contain' => ['Sources']
        ]);
        $this->set('talent', $talent);
        $this->set('_serialize', ['talent']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $talent = $this->Talents->newEntity();
        if ($this->request->is('post')) {
            $talent = $this->Talents->patchEntity($talent, $this->request->data);
            if ($this->Talents->save($talent)) {
                $this->Flash->success(__('The talent has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The talent could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Talents->Characters->find('list', ['limit' => 200]);
        $this->set(compact('talent', 'characters'));
        $this->set('_serialize', ['talent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Talent id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $talent = $this->Talents->get($id, [
            'contain' => ['Characters']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $talent = $this->Talents->patchEntity($talent, $this->request->data);
            if ($this->Talents->save($talent)) {
                $this->Flash->success(__('The talent has been saved.'));
                return $this->redirect(['action' => 'view', $talent->id]);
            } else {
                $this->Flash->error(__('The talent could not be saved. Please, try again.'));
            }
        }

        $characters = $this->Talents->Characters->find('list', ['limit' => 200]);
        $this->set(compact('talent', 'characters'));
        $this->set('_serialize', ['talent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $talent = $this->Talents->get($id);
        if ($this->Talents->delete($talent)) {
            $this->Flash->success(__('The talent has been deleted.'));
        } else {
            $this->Flash->error(__('The talent could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
