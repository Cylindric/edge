<?php
namespace App\Controller;

use App\Controller\AppController;

class SkillsController extends AppController
{

    public function index()
    {
        $this->paginate = [
            'contain' => ['Stats']
        ];
        $this->set('skills', $this->paginate($this->Skills));
        $this->set('_serialize', ['skills']);
    }

    public function view($id = null)
    {
        $skill = $this->Skills->get($id, [
            'contain' => ['Stats', 'Training']
        ]);
        $this->set('skill', $skill);
        $this->set('_serialize', ['skill']);
    }

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
        $Stats = $this->Skills->Stats->find('list', ['limit' => 200]);
        $this->set(compact('skill', 'Stats'));
        $this->set('_serialize', ['skill']);
    }

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
        $Stats = $this->Skills->Stats->find('list', ['limit' => 200]);
        $this->set(compact('skill', 'Stats'));
        $this->set('_serialize', ['skill']);
    }

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

    public function export()
    {
        $this->set('data', ['skills' => $this->Skills->export()]);
        $this->set('_serialize', 'data');
    }
}
