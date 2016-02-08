<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class SkillsTable extends AppTable
{

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->belongsTo('Stats', [
			'foreignKey' => 'stat_id',
			'joinType' => 'INNER'
		]);
		$this->hasMany('CharactersSkills');
		$this->belongsToMany('Characters');
		$this->belongsTo('Sources');
	}

	public function validationDefault(Validator $validator)
	{
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create');

		$validator
			->requirePresence('name', 'create')
			->notEmpty('name');

		return $validator;
	}

	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['stat_id'], 'Stats'));
		return $rules;
	}

	public function export()
	{
		return $this
			->find()
			->contain(['Sources', 'Stats'])
			->select(['Skills.name', 'Skills.skilltype_id', 'Stats.name', 'Sources.name']);
	}

}
