<?php
namespace App\Model\Rpg;

use Cake\ORM\TableRegistry;

class CalculatorFactory
{
    public static function getSpecies($species, $entity)
    {
        $class_name = 'App\Model\Rpg\Species\\'.$species->class;
        $o = new $class_name($species, $entity);
        return $o;
    }
}