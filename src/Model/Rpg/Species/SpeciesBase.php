<?php

namespace App\Model\Rpg\Species;

use Cake\ORM\TableRegistry;

class SpeciesBase
{
    protected $_species;
    protected $_entity;

    function __construct($species, $entity)
    {
        $this->_species = $species;
        $this->_entity = $entity;
    }

    protected function GetCharacteristic($name)
    {
        $growth = TableRegistry::get('Growth');
        $query = $growth
            ->find()
            ->contain('Characteristics');

        $query->select(['total' => $query->func()->sum('level')])
            ->where(['characteristics.name' => $name])
            ->first();

        return $query->toArray()[0]->total;
    }

    public function getBrawn()
    {
        return $this->GetCharacteristic('Brawn');
    }

    public function getAgility()
    {
        return $this->GetCharacteristic('Agility');
    }

    public function getIntellect()
    {
        return $this->GetCharacteristic('Intellect');
    }

    public function getCunning()
    {
        return $this->GetCharacteristic('Cunning');
    }

    public function getWillpower()
    {
        return $this->GetCharacteristic('Willpower');
    }

    public function getPresence()
    {
        return $this->GetCharacteristic('Presence');
    }

    /*
     * Core page 94
     * SpeciesWound + Brawn
     */
    public function getWounds()
    {
        return $this->_species->base_wound + $this->getBrawn();
    }

    /*
     * Core page 94
     * SpeciesStrain + Willpower
     */
    public function getStrain()
    {
        return $this->_species->base_strain + $this->getWillpower();
    }
}