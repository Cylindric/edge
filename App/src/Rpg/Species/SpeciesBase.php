<?php
namespace App\Rpg\Species;

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

    public function applyCreationStats()
    {
		$chars = TableRegistry::get('Characters');
		$this->_entity->stat_br   = $this->Species->stat_br;
		$this->_entity->stat_ag   = $this->Species->stat_ag;
		$this->_entity->stat_int  = $this->Species->stat_int;
		$this->_entity->stat_cun  = $this->Species->stat_cun;
		$this->_entity->stat_will = $this->Species->stat_will;
		$this->_entity->stat_pr   = $this->Species->stat_pr;
		$chars->save($this->_entity);
	}

    public function applyCreationSkills()
    {}

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
        return $this->_entity->stat_br;
    }}