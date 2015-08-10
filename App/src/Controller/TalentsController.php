<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Talents Controller
 *
 * @property \App\Model\Table\TalentsTable $Talents
 */
class TalentsController extends AppController
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

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $term = trim($this->request->query('term'));
        if (!empty($term)) {
            $talents = $this->Talents->find('list')->where(['name LIKE' => $term . '%']);
        } else {
            $talents = $this->paginate($this->Talents);
        }
        $this->set('talents', $talents);
        $this->set('_serialize', ['talents']);
    }

}
