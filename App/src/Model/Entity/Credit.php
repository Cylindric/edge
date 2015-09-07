<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Credit extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
