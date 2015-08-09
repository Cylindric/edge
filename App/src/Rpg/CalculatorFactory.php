<?php
namespace App\Rpg;

use Cake\ORM\TableRegistry;

class CalculatorFactory
{
    public static function getSpecies($species, $entity)
    {
        $class_name = 'App\Rpg\Species\\'.$species->class;
        $o = new $class_name($species, $entity);
        return $o;
    }
}