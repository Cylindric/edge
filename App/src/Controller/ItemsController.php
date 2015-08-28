<?php
namespace App\Controller;

use App\Controller\AppController;


class ItemsController extends AppController
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
                $items = $this->Items
                    ->find('all')
                    ->select(['value' => 'id', 'label' => 'name'])
                    ->where(['name LIKE' => '%' . $term . '%']);
            } else {
                $items = array();
            }
        } else{
            $items = $this->paginate($this->Items);
        }
        $this->set('items', $items);
        $this->set('_serialize', 'items');
    }

}
