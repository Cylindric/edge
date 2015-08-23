<?php
namespace App\Controller;

use App\Controller\AppController;


class WeaponsController extends AppController
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
                $weapons = $this->Weapons
                    ->find('all')
                    ->select(['value' => 'id', 'label' => 'name'])
                    ->where(['name LIKE' => '%' . $term . '%']);
            } else {
                $weapons = array();
            }
        } else{
            $weapons = $this->paginate($this->Weapons);
        }
        $this->set('weapons', $weapons);
        $this->set('_serialize', 'weapons');
    }

}
