<?php
namespace App\Model\Table;

use App\Model\Entity\ItemType;
use Cake\Validation\Validator;

class ItemTypesTable extends AppTable
{

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->addBehavior('Timestamp');
		$this->belongsTo('Sources');
		$this->hasMany('Items', [
			'foreignKey' => 'item_type_id'
		]);
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
}
