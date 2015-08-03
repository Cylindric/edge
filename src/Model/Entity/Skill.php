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
        $ability = 0;
        $proficiency = 0;

        $level = (int)$this->level;
        $statname = 'stat_' . strtolower($this->stat->code);

        $stat = $character->$statname;

        // Green dice
        if ($level > $stat) {
            $ability = ($level - $stat) % 2;
        } else {
            $ability = $stat - $level;
        }

        // Yellow dice
        if ($level > $stat) {
            $proficiency = (int)((float)($level - $stat) / 2) + $stat;
        } else {
            $proficiency = $level;
        }

        return array($proficiency, $ability);
    }
}
