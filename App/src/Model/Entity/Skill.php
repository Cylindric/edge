<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Skill Entity.
 */
class Skill extends Entity
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


    public function dice($character)
    {
        $stat_name = 'stat_' . strtolower($this->stat->code);

        // Work out the current skill level
        $query = TableRegistry::get('CharactersSkills')->find();
        $query
            ->where(['character_id' => $character->id, 'skill_id' => $this->id])
            ->select(['level' => $query->func()->sum('level')])
            ->hydrate(false);
        $level = $query->toArray()[0]['level'];

        $stat = $character->$stat_name;

        // Total dice is the highest of the Characteristic or the Skill
        $total_dice = max($level, $stat);

        // Number of Proficiency dice is the lower of the Characteristic and the Skill
        $proficiency_dice = min($level, $stat);

        // Number of ability d  ice is the rest
        $ability_dice = $total_dice - $proficiency_dice;

        /* This is the logic to calculate additional dice from upgrades, not yet implemented.
        // Green dice
        if ($this->level > $stat) {
            $ability = ($this->level - $stat) % 2;
        } else {
            $ability = $stat - $this->level;
        }

        // Yellow dice
        if ($this->level > $stat) {
            $proficiency = (int)((float)($this->level - $stat) / 2) + $stat;
        } else {
            $proficiency = $this->level;
        }
        */

        return array(
            $proficiency_dice,
            $ability_dice,
            'proficiency' => $proficiency_dice,
            'ability' => $ability_dice
        );
    }
}
