<?php
namespace App\Controller;

use App\Controller\AppController;

class NotesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
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

}