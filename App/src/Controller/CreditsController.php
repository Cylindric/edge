<?php
namespace App\Controller;

use App\Controller\AppController;

class CreditsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Characters');
        $this->loadModel('Credits');
    }

    public function isAuthorized($user)
    {
        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
            'add',
            'edit',
            'delete'
        ])) {
            if ($this->request->is('post')) {
                $character_id = $this->request->data['character_id'];
            } else {
                $character_id = (int)$this->request->params['pass'][0];
            }
            if ($this->Characters->isOwnedBy($character_id, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function add()
    {
        $credit = $this->Credits->newEntity();
        if ($this->request->is('post')) {
            $char = $this->Characters->get($this->request->data['character_id']);
            $credit = $this->Credits->patchEntity($credit, $this->request->data);
            if ($this->Credits->save($credit)) {
                $response = ['result' => 'success', 'data' => $credit];
            } else {
                $response = ['result' => 'fail', 'data' => $credit];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function edit($character_id = null)
    {
        $credits = $this->Credits
            ->find()
            ->where(['character_id' => $character_id])
            ->order('created DESC');

        $query = $this->Credits->find();
        $query
            ->where(['character_id' => $character_id])
            ->select(['total' => $query->func()->sum('value')])
            ->hydrate(false);
        $total = $query->toArray()[0]['total'];


        $this->set('credits', $credits->toArray());
        $this->set('total', $total);
        $this->set('_serialize', ['character']);
    }


    public function delete($id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($id)) {
            if ($this->Credits->delete($this->Credits->get($id))) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

}
