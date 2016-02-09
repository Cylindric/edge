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

    public function _getTotalCredits()
    {
        $Credits = TableRegistry::get('Credits');
        $credits = $Credits->find();
        $credits
            ->where(['Credits.character_id' => $this->id])
            ->select(['total' => $credits->func()->sum('Credits.value')])
            ->hydrate(false);

        $total = $credits->toArray()[0]['total'] ?: 0;
        if($total == null)
        {
            $total = 0;
        }
        return $total;
    }

    public function _getTotalXp()
    {
        $Xp = TableRegistry::get('Xp');
        $xp = $Xp->find();
        $xp
            ->where(['Xp.character_id' => $this->id])
            ->select(['xp' => $xp->func()->sum('Xp.value')])
            ->hydrate(false);
        return $xp->toArray()[0]['xp'] ?: 0;
    }

    public function _getTotalObligation()
    {
        $Obligations = TableRegistry::get('Obligations');
        $obligation = $Obligations->find();
        $obligation
            ->where(['Obligations.character_id' => $this->id])
            ->select(['obligation' => $obligation->func()->sum('Obligations.value')])
            ->hydrate(false);
        return $obligation->toArray()[0]['obligation'] ?: 0;
    }

    public function _getTotalStrainThresholdBreakdown()
    {
        $breakdown = array();

        // Strain Threshold is initially based on Species.
        $Species = TableRegistry::get('Species');
        $species = $Species->get($this->species_id);
        $breakdown['Species'] = $species->base_strain;

        // Willpower is added
        $breakdown['Willpower'] = $this->willpower;

        // Talents may add Strain Threshold
        $Talents = TableRegistry::get('CharactersTalents');
        $query = $Talents->find();
        $query
            ->contain(['Talents'])
            ->where(['CharactersTalents.character_id' => $this->id])
            ->select(['strain' => $query->func()->sum('CharactersTalents.rank * Talents.strain_per_rank')])
            ->hydrate(false);
        $breakdown['Talents'] = $query->toArray()[0]['strain'] ?: 0;

        // Finally any arbitrary adjustments are added
        $breakdown['Manual'] = $this->strain_threshold;

        return $breakdown;
    }

    public function _getTotalStrainThreshold()
    {
        return array_sum($this->_getTotalStrainThresholdBreakdown());
    }

    public function _getTotalWoundThresholdBreakdown()
    {
        $breakdown = array();

        // Wound Threshold is initially based on Species.
        $Species = TableRegistry::get('Species');
        $species = $Species->get($this->species_id);
        $breakdown['Species'] = $species->base_wound;

        // Brawn is added
        $breakdown['Willpower'] = $this->brawn;

        // Finally any arbitrary adjustments are added
        $breakdown['Manual'] = $this->wound_threshold;

        return $breakdown;
    }

    public function _getTotalWoundThreshold()
    {
        return array_sum($this->_getTotalWoundThresholdBreakdown());
    }

    protected function _getTotalSoakBreakdown()
    {
        $breakdown = array();

        // Soak is initially based on Brawn.
        $breakdown['Basic'] = $this->stat_br;

        // Armour will usually add Soak.
        $Armour = TableRegistry::get('CharactersArmour');
        $query = $Armour->find();
        $query
            ->contain(['Armour'])
            ->where(['CharactersArmour.character_id' => $this->id])
            ->andWhere(['CharactersArmour.equipped' => true])
            ->select(['soak' => $query->func()->sum('Armour.soak')])
            ->hydrate(false);
        $breakdown['Armour'] = $query->toArray()[0]['soak'] ?: 0;

        // Talents may add Soak
        $Talents = TableRegistry::get('CharactersTalents');
        $query = $Talents->find();
        $query
            ->contain(['Talents'])
            ->where(['CharactersTalents.character_id' => $this->id])
            ->select(['soak' => $query->func()->sum('CharactersTalents.rank * Talents.soak_per_rank')])
            ->hydrate(false);
        $breakdown['Talents'] = $query->toArray()[0]['soak'] ?: 0;

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
        $armour_defence = $query->toArray()[0]['defence'] ?: 0;

        $defence['melee'] += $armour_defence;
        $defence['ranged'] += $armour_defence;
        return $defence;
    }

    public function _getBrawn()
    {
        return $this->stat_br;
    }

    public function _getAgility()
    {
        return $this->stat_ag;
    }

    public function _getIntellect()
    {
        return $this->stat_int;
    }

    public function _getCunning()
    {
        return $this->stat_cun;
    }

    public function _getWillpower()
    {
        return $this->stat_will;
    }

    public function _getPresence()
    {
        return $this->stat_pr;
    }

}
