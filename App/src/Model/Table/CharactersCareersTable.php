<?php
namespace App\Model\Table;

use App\Model\Entity\CharactersCareers;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class CharactersCareersTable extends AppTable
{

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->table('characters_careers');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Characters', [
			'foreignKey' => 'character_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Careers', [
			'foreignKey' => 'career_id',
			'joinType' => 'INNER'
		]);
	}

	public function validationDefault(Validator $validator)
	{
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create');

		return $validator;
	}

	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['character_id'], 'Characters'));
		$rules->add($rules->existsIn(['career_id'], 'Careers'));
		return $rules;
	}
}
