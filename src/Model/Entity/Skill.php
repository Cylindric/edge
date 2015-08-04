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


    public function _getLevel() {
        if(count($this->training) > 0) {
            return (int)$this->training[0]->level;
        } else {
            return 0;
        }
    }

    public function dice($character)
    {
        $statname = 'stat_' . strtolower($this->stat->code);

        $stat = $character->$statname;

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

        return array(
            $proficiency,
            $ability,
            'proficiency' => $proficiency,
            'ability' => $ability
        );
    }
}
