<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use App\Rpg;

class Group extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function _getObligation() {
        $chars = TableRegistry::get('Characters');

        $query = $chars->find();
        $query->select(['total' => $query->func()->sum('obligation')])
            ->where(['group_id' => $this->id]);
        return $query->toArray()[0]->total;
    }

    public function _getCredits() {
        $chars = TableRegistry::get('Characters');

        $query = $chars->find();
        $query->select(['total' => $query->func()->sum('credits')])
            ->where(['group_id' => $this->id]);
        return $query->toArray()[0]->total;
    }

    public function _getXp() {
        $chars = TableRegistry::get('Characters');

        $query = $chars->find();
        $query->select(['total' => $query->func()->sum('xp')])
            ->where(['group_id' => $this->id]);
        return $query->toArray()[0]->total;
    }
}