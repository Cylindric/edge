<?php
namespace App\Rpg\Species;

use Cake\ORM\TableRegistry;

class Human extends SpeciesBase
{
    function __construct($species, $entity)
    {
        parent::__construct($species, $entity);
    }
}