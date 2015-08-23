<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class Range extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

}
