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
        } elseif ($this->request->is('json')) {
            $weapons = $this->Weapons->find()->contain(['WeaponTypes', 'Ranges', 'Sources'])->select(['name', 'encumbrance', 'rarity', 'damage', 'crit', 'hp', 'value', 'restricted', 'special', 'Ranges.name', 'WeaponTypes.name', 'Sources.name']);
            /*
             *         "id": 1,
        "weapon_type_id": 1,
        "skill_id": 26,
        "range_id": 2,
        "name": "Holdout Blaster",
        "encumbrance": 1,
        "rarity": 4,
        "damage": 5,
        "crit": 4,
        "hp": 1,
        "value": 200,
        "restricted": false,
        "special": "Stun setting",
        "created": "2016-01-31T21:24:16+0000",
        "modified": "2016-01-31T21:24:16+0000",
        "range": {
            "id": 2,
            "name": "Short",
            "created": "2016-01-31T21:24:12+0000",
            "modified": "2016-01-31T21:24:12+0000"
        },
        "weapon_type": {
            "id": 1,
            "name": "Energy Weapons",
            "created": "2016-01-31T21:24:15+0000",
            "modified": "2016-01-31T21:24:15+0000"
        }

             */
        } else{
            $weapons = $this->paginate($this->Weapons);
        }
        $this->set('weapons', $weapons);
        $this->set('_serialize', 'weapons');
    }

}
