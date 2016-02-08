<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class NotesTable extends AppTable
{

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->displayField('note');
		$this->addBehavior('Timestamp');
		$this->BelongsToMany('Characters', [
			'through' => 'CharactersNotes'
		]);
	}

	public function validationDefault(Validator $validator)
	{
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create');

		$validator
			->requirePresence('note', 'create')
			->notEmpty('note');

		return $validator;
	}
}
