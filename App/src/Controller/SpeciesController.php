<?php
namespace App\Controller;

use App\Controller\AppController;

class SpeciesController extends AppController
{

    public function index()
    {
        $this->set('species', $this->paginate($this->Species));
        $this->set('_serialize', ['species']);
    }

    public function view($id = null)
    {
        $species = $this->Species->get($id, [
            'contain' => ['Sources']
        ]);
        $this->set('species', $species);
        $this->set('_serialize', ['species']);
    }

    public function add()
    {
        $species = $this->Species->newEntity(['source_id' => 1]);
        if ($this->request->is('post')) {
            $species = $this->Species->patchEntity($species, $this->request->data);
            if ($this->Species->save($species)) {
                $this->Flash->success(__('The species has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The species could not be saved. Please, try again.'));
            }
        }
        $sources = $this->Species->Sources->find('list')->toArray();
        $this->set(compact('species', 'sources'));
        $this->set('_serialize', ['species']);
    }

    public function edit($id = null)
    {
        $species = $this->Species->get($id, [
            'contain' => ['Sources']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $species = $this->Species->patchEntity($species, $this->request->data);
            if ($this->Species->save($species)) {
                $this->Flash->success(__('The species has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The species could not be saved. Please, try again.'));
            }
        }

        $sources = $this->Species->Sources->find('list')->toArray();
        $this->set(compact('species', 'sources'));
        $this->set('_serialize', ['species']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $species = $this->Species->get($id);
        if ($this->Species->delete($species)) {
            $this->Flash->success(__('The species has been deleted.'));
        } else {
            $this->Flash->error(__('The species could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
