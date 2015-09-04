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

}
