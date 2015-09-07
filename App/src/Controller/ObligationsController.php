<?php
namespace App\Controller;

use App\Controller\AppController;

class ObligationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Characters');
        $this->loadModel('Obligations');
    }

    public function isAuthorized($user)
    {
        if ($this->request->action === 'index') {
            return true;
        }

        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
            'add',
            'edit',
            'delete'
        ])) {
            if ($this->request->is('post')) {
                $char = $this->Characters->get($this->request->data['character_id']);
                if ($this->Characters->isOwnedBy($char->id, $user['id'])) {
                    return true;
                }
            }
        }

        return parent::isAuthorized($user);
    }

    public function add()
    {
        $note = $this->Obligations->newEntity();
        if ($this->request->is('post')) {
            $obligation = $this->Obligations->patchEntity($note, $this->request->data);
            if ($this->Obligations->save($obligation)) {
                $response = ['result' => 'success', 'data' => $obligation];
            } else {
                $response = ['result' => 'fail', 'data' => $obligation];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function edit($character_id = null)
    {
        $obligations = $this->Obligations
            ->find()
            ->where(['character_id' => $character_id])
            ->order('created DESC');

        $query = $this->Obligations->find();
        $query
            ->where(['character_id' => $character_id])
            ->select(['total' => $query->func()->sum('value')])
            ->hydrate(false);
        $total = $query->toArray()[0]['total'];

        $this->set('obligations', $obligations->toArray());
        $this->set('total', $total);
        $this->set('_serialize', ['character']);
    }

    public function delete($obligation_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($obligation_id)) {
            if ($this->Obligations->delete($this->Obligations->get($obligation_id))) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }
}