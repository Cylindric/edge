<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class ObligationsTable extends AppTable
{

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->addBehavior('Timestamp');
		$this->addBehavior('Ceeram/Blame.Blame');
		$this->belongsTo('Characters');
		$this->belongsTo('CreatedUser', [
			'className' => 'Users',
			'foreignKey' => 'created_by',
		]);
		$this->belongsTo('ModifyUser', [
			'className' => 'Users',
			'foreignKey' => 'modified_by',
		]);
	}

	public function validationDefault(Validator $validator)
	{
		return $validator
			->notEmpty('value', 'A value is required')
			->notEmpty('type', 'A type is required');
	}

	public function totalForCharacter($character_id)
	{
		$query = $this->find();
		$query
			->where(['character_id' => $character_id])
			->select(['total' => $query->func()->sum('value')])
			->hydrate(false);
		$query = $query->first();

		if ($query['total'] === null) {
			$query['total'] = 0;
		}
		return $query['total'];
	}

}