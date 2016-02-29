<?php

namespace App\Controller;

use App\Controller\AppController;

class WeaponsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user) {
        if ($this->request->action === 'index') {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        if ($this->request->is('json')) {
            $weapons = $this->Weapons
                    ->find('all')
                    ->select(['id', 'name']);
        } else {
            $weapons = $this->paginate($this->Weapons);
        }

        $this->set('weapons', $weapons);
        $this->set('_serialize', 'weapons');
    }

    public function export() {
        $this->set('data', ['weapons' => $this->Weapons->export()]);
        $this->set('_serialize', 'data');
    }

}
