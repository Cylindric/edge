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

    public function _getTotalCredits()
    {
        $Credits = TableRegistry::get('Credits');
        $credits = $Credits->find();
        $credits
            ->where(['Credits.character_id' => $this->id])
            ->select(['total' => $credits->func()->sum('Credits.value')])
            ->hydrate(false);
        return $credits->toArray()[0]['total'];
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

    public function _getTotalObligation()
    {
        $Obligations = TableRegistry::get('Obligations');
        $obligation = $Obligations->find();
        $obligation
            ->where(['Obligations.character_id' => $this->id])
            ->select(['obligation' => $obligation->func()->sum('Obligations.value')])
            ->hydrate(false);
        return $obligation->toArray()[0]['obligation'];
    }

    public function _getTotalSoakBreakdown()
    {
        if (!$this->_species)
            $this->_updateSpecies();

        $breakdown = array();

        // Default Soak is zero.
        $soak = 0;

        // Soak is initially based on Brawn.
        $breakdown['Species'] = Rpg\CalculatorFactory::getSpecies($this->_species, $this)->getSoak();

        // Armour will usually add Soak.
        $Armour = TableRegistry::get('CharactersArmour');
        $query = $Armour->find();
        $query
            ->contain(['Armour'])
            ->where(['CharactersArmour.character_id' => $this->id])
            ->andWhere(['CharactersArmour.equipped' => true])
            ->select(['soak' => $query->func()->sum('Armour.soak')])
            ->hydrate(false);
        $breakdown['Armour'] = $query->toArray()[0]['soak'];

        // Finally any arbitrary adjustments are added
        $breakdown['Manual'] = $this->soak;

        return $breakdown;

    }

    public function _getTotalSoak()
    {
        return array_sum($this->_getTotalSoakBreakdown());
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
