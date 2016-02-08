<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class SourcesTable extends AppTable
{
	public function validationDefault(Validator $validator)
	{
		return $validator
			->notEmpty('name', 'A name is required')
			;
	}
}