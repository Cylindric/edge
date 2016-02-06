<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Talents Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Characters
 */
class TalentsTable extends Table
{

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->displayField('name');
		$this->addBehavior('Timestamp');
		$this->BelongsTo('Sources');
		$this->BelongsToMany('Characters', [
			'through' => 'CharactersTalents'
		]);
	}

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator)
	{
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create');

		$validator
			->requirePresence('name', 'create')
			->notEmpty('name');

		$validator
			->add('ranked', 'valid', ['rule' => 'boolean']);

		return $validator;
	}

	public function import($record)
	{
		// Populate the linked data
		if (array_key_exists('source', $record)) {
			$source = $this->Sources->findByName($record['source']->name)->first();
			$record['source_id'] = $source->id;
		}

		$found = $this->find()->where(['name' => $record['name']])->first();
		if ($found) {
			$result = $this->patchEntity($found, $record);
			$result->import_action = "updated";
		} else {
			$result = $this->newEntity($record);
			$result->import_action = "created";
		}

		if ($this->save($result)) {
			// okay result
		} else {
			$result->import_action = "failed";
			$result->import_errors = $result->errors();
		}

		$result->import_name = $result->name;
		return $result;
	}

}
