<?php
namespace App\Model\Rpg\Species;

use Cake\ORM\TableRegistry;

class Droid extends SpeciesBase
{
	function __construct($species, $entity)
	{
		parent::__construct($species, $entity);
	}
}