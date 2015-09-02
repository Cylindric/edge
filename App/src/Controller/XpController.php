<?php
namespace App\Controller;

use App\Controller\AppController;

class XpController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Characters');
        $this->loadModel('Xp');
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

    public function delete($xp_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($xp_id)) {
            if ($this->Xp->delete($this->Xp->get($xp_id))) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function add()
    {
        $note = $this->Xp->newEntity();
        if ($this->request->is('post')) {
            $char = $this->Characters->get($this->request->data['character_id']);
            $xp = $this->Xp->patchEntity($note, $this->request->data);
            if ($this->Xp->save($xp)) {
                $response = ['result' => 'success', 'data' => $xp];
            } else {
                $response = ['result' => 'fail', 'data' => $xp];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

}
