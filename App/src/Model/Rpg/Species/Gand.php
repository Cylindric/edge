<?php
namespace App\Model\Rpg\Species;

use Cake\ORM\TableRegistry;

class Gand extends SpeciesBase
{
	function __construct($species, $entity)
	{
		parent::__construct($species, $entity);
	}

	public function applyCreationSkills()
	{
		$skills = TableRegistry::get('Skills');
		$skill = $skills->findByName('Discipline')->first();

		$training = TableRegistry::get('Training');
		$t = $training->newEntity();
		$t->skill_id = $skill->id;
		$t->character_id = $this->_entity->id;
		$t->level = 1;
		$training->save($t);
	}

}