<?php
namespace App\Controller;

use App\Controller\AppController;

class CharactersNotesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Characters');
        $this->loadModel('Notes');
    }

    public function isAuthorized($user)
    {
        if ($this->request->action === 'index') {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function delete($note_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($note_id)) {

            if ($this->Notes->delete($this->Notes->get($note_id))) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function add()
    {
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {
            $char = $this->Characters->get($this->request->data['charId']);
            $note = $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Characters->Notes->link($char, [$note]);
                $response = ['result' => 'success', 'data' => $note];
            } else {
                $response = ['result' => 'fail', 'data' => $note];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

}
