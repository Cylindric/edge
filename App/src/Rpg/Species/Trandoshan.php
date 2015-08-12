<?php
namespace App\Rpg\Species;

use Cake\ORM\TableRegistry;

class Trandoshan extends SpeciesBase
{
	function __construct($species, $entity)
	{
		parent::__construct($species, $entity);
	}

	public function applyCreationSkills()
	{
		$skills = TableRegistry::get('Skills');
		
		$new_skills = ['Perception', 'Claws', 'Regeneration'];
		
		foreach($new_skills as $skill)
		{
			$skill = $skills->findByName($skill)->first();

			$training = TableRegistry::get('Training');
			$t = $training->newEntity();
			$t->skill_id = $skill->id;
			$t->character_id = $this->_entity->id;
			$t->level = 1;
			$training->save($t);
		}
	}

}