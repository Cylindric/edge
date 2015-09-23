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
    public function _getWounds()
    {
        return $this->Species->base_wound + $this->_entity->stat_br;
    }

    /*
     * Core page 94
     * SpeciesStrain + Willpower
     */
    public function _getStrain()
    {
        return $this->Species->base_strain + $this->_entity->stat_will;
    }

    /*
     * Core page 94
     * Brawn
     */
    public function getSoak()
    {
        return $this->_entity->stat_br;
    }

    protected function applySkills($skills)
    {
        $Skills = TableRegistry::get('Skills');
        $CharactersSkills = TableRegistry::get('CharactersSkills');
        
        foreach($skills as $skill)
        {
            $skill = $Skills->findByName($skill)->first();

            $new = $CharactersSkills->newEntity();
            $new->character_id = $this->_entity->id;
            $new->skill_id = $skill->id;
            $new->level = 1;
            if ($CharactersSkills->save($new)) {
                $response['result'] = 'success';
            };


        }
    }

    protected function applyTalents($talents)
    {
        $Talents = TableRegistry::get('Talents');
        $CharactersTalents = TableRegistry::get('CharactersTalents');
        foreach($talents as $talent)
        {
            $talent = $Talents->findByName($talent)->first();

            $new = $CharactersTalents->newEntity();
            $new->talent_id = $talent->id;
            $new->character_id = $this->_entity->id;
            $new->level = 1;
            if($CharactersTalents->save($new))
            {
                $response['result'] = 'success';
            }
        }
    }
}