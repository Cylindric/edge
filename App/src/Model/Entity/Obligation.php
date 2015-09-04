<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Obligation extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
