<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use App\Model\Rpg;


/**
 * Character Entity.
 */
class Character extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    private $_species;

    private function _updateSpecies()
    {
        $species = TableRegistry::get('Species');
        $this->_species = $species->get($this->_properties['species_id']);
    }

    public function _getBrawn()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getBrawn();
    }

    public function _getAgility()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getAgility();
    }

    public function _getIntellect()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getIntellect();
    }

    public function _getCunning()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getCunning();
    }

    public function _getWillpower()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getWillpower();
    }

    public function _getPresence()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getPresence();
    }

    public function _getWounds()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getWounds();
    }

    public function _getStrain()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getStrain();
    }
    public function _getSoak()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getSoak();
    }
}
