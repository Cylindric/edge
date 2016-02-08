<?php
namespace App\Model\Table;

use App\Model\Entity\CharactersItem;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class CharactersItemsTable extends AppTable
{

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->addBehavior('Timestamp');
		$this->belongsTo('Characters', [
			'foreignKey' => 'character_id',
			'joinType' => 'INNER'
		]);
		$this->belongsTo('Items', [
			'foreignKey' => 'item_id',
			'joinType' => 'INNER'
		]);
	}

	public function validationDefault(Validator $validator)
	{
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create');

		$validator
			->add('quantity', 'valid', ['rule' => 'numeric'])
			->requirePresence('quantity', 'create')
			->notEmpty('quantity');

		$validator
			->add('equipped', 'valid', ['rule' => 'boolean'])
			->requirePresence('equipped', 'create')
			->notEmpty('equipped');

		return $validator;
	}

	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['character_id'], 'Characters'));
		$rules->add($rules->existsIn(['item_id'], 'Items'));
		return $rules;
	}
}
