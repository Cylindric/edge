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
}