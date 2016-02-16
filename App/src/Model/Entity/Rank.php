<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Rank extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}