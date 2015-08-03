<?php

namespace App\Model\Rpg\Species;

use Cake\ORM\TableRegistry;

class SpeciesBase
{
    public $Species;
    protected $_entity;

    function __construct($species, $entity)
    {
        $this->Species = $species;
        $this->_entity = $entity;
    }

    /*
     * Core page 94
     * SpeciesWound + Brawn
     */
    public function getWounds()
    {
        return $this->Species->base_wound + $this->_entity->stat_br;
    }

    /*
     * Core page 94
     * SpeciesStrain + Willpower
     */
    public function getStrain()
    {
        return $this->Species->base_strain + $this->_entity->stat_will;
    }

    public function getSoak()
    {
        return $this->Species->base_strain + $this->_entity->stat_br;
    }}