<?php
namespace App\Controller;

use App\Controller\AppController;


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

}
