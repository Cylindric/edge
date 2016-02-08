<?php
namespace App\Controller;


class ArmourController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user)
    {
        if ($this->request->action === 'index') {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function index()
    {
        if($this->request->is('ajax')) {
            $term = trim($this->request->query('term'));
            if (!empty($term)) {
                $armour = $this->Armour
                    ->find('all')
                    ->select(['value' => 'id', 'label' => 'name'])
                    ->where(['name LIKE' => '%' . $term . '%']);
            } else {
                $armour = array();
            }
        } else{
            $armour = $this->paginate($this->Armour);
        }
        $this->set('armour', $armour);
        $this->set('_serialize', 'armour');
    }

    public function view($id)
    {
        $armour = $this->Armour->get($id, [
            'contain' => ['Sources']
        ]);
        $this->set('armour', $armour);
        $this->set('_serialize', ['armour']);
    }

    public function add()
    {
        $armour = $this->Armour->newEntity(['source_id' => 1]);
        if ($this->request->is('post')) {
            $armour = $this->Armour->patchEntity($armour, $this->request->data);
            if ($this->Armour->save($armour)) {
                $this->Flash->success(__('The armour has been saved.'));
                return $this->redirect(['action' => 'view', $armour->id]);
            } else {
                $this->Flash->error(__('The armour could not be saved. Please, try again.'));
            }
        }
        $sources = $this->Armour->Sources->find('list')->toArray();
        $this->set(compact('armour', 'sources'));
        $this->set('_serialize', ['armour']);
    }

     public function edit($id)
    {
        $armour = $this->Armour->get($id, [
            'contain' => ['Sources']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $armour = $this->Armour->patchEntity($armour, $this->request->data);
            if ($this->Armour->save($armour)) {
                $this->Flash->success(__('The armour has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The armour could not be saved. Please, try again.'));
            }
        }

        $sources = $this->Armour->Sources->find('list')->toArray();
        $this->set(compact('armour', 'sources'));
        $this->set('_serialize', ['armour']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $armour = $this->Armour->get($id);
        if ($this->Armour->delete($armour)) {
            $this->Flash->success(__('The armour has been deleted.'));
        } else {
            $this->Flash->error(__('The armour could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function export()
    {
        $this->set('data', ['armour' => $this->Armour->export()]);
        $this->set('_serialize', 'data');
    }

}
