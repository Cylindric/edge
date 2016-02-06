<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SourcesTable extends Table
{

	public function initialize(array $config)
	{
		parent::initialize($config);
	}

	public function validationDefault(Validator $validator)
	{
		return $validator
			->notEmpty('name', 'A name is required')
			;
	}

	public function import($record)
	{
		$new = $this->newEntity($record);
		$found = $this->find()->where(['name' => $record['name']])->first();
		if ($found)
		{
			$result = $found;
			$result->import_action = "skipped";
		}
		else
		{
			$result = $new;
			if($this->save($result))
			{
				$result->import_action = "created";
			}
			else
			{
				$result->import_action = "failed";
			}
		}
		$result->import_name = $result->name;
		return $result;
	}
}