<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


class CharactersSkill extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
