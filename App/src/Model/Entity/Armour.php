<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class Armour extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

}
