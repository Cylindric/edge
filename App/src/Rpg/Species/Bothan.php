<?php
namespace App\Rpg\Species;

use Cake\ORM\TableRegistry;

class Bothan extends SpeciesBase
{
	function __construct($species, $entity)
	{
		parent::__construct($species, $entity);
	}

	public function applyCreationSkills()
	{
		$this->applySkills(['Streetwise']);
	}

}