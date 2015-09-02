<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use App\Rpg;


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

    public function _getTotalXp()
    {
        $Xp = TableRegistry::get('Xp');
        $xp = $Xp->find();
        $xp
            ->where(['Xp.character_id' => $this->id])
            ->select(['xp' => $xp->func()->sum('Xp.value')])
            ->hydrate(false);
        return $xp->toArray()[0]['xp'];
    }

    public function _getTotalSoak()
    {
        $base_soak = $this->soak;
        $Armour = TableRegistry::get('CharactersArmour');
        $query = $Armour->find();
        $query
            ->contain(['Armour'])
            ->where(['CharactersArmour.character_id' => $this->id])
            ->andWhere(['CharactersArmour.equipped' => true])
            ->select(['soak' => $query->func()->sum('Armour.soak')])
            ->hydrate(false);
        $armour_soak = $query->toArray()[0]['soak'];

        return $base_soak + $armour_soak;
    }

    public function _getTotalDefence()
    {
        $defence = ['melee' => $this->defence_melee, 'ranged' => $this->defence_ranged];

        $Armour = TableRegistry::get('CharactersArmour');
        $query = $Armour->find();
        $query
            ->contain(['Armour'])
            ->where(['CharactersArmour.character_id' => $this->id])
            ->andWhere(['CharactersArmour.equipped' => true])
            ->select(['defence' => $query->func()->sum('Armour.defence')])
            ->hydrate(false);
        $armour_defence = $query->toArray()[0]['defence'];

        $defence['melee'] += $armour_defence;
        $defence['ranged'] += $armour_defence;
        return $defence;
    }

    public function _getBrawn()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->Species->stat_br;
    }

    public function _getAgility()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->Species->stat_ag;
    }

    public function _getIntellect()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->Species->stat_int;
    }

    public function _getCunning()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->Species->stat_cun;
    }

    public function _getWillpower()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->Species->stat_will;
    }

    public function _getPresence()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        return Rpg\CalculatorFactory::getSpecies($this->_species, $this)->Species->stat_pr;
    }

}
