<?php
namespace App\Model\Rpg;

use Cake\ORM\TableRegistry;

class CalculatorFactory
{
    public static function getSpecies($species, $entity)
    {
        $classname = 'App\Model\Rpg\Species\\'.$species->class;
        $o = new $classname($species, $entity);
        return $o;
    }
}