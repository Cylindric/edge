<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

class ImportForm extends Form
{
	public $results = array();

	protected function _buildSchema(Schema $schema)
	{
		return $schema->addField('json_data', 'string');
	}

	protected function _execute(array $data)
	{
		$json = json_decode($data['json_data']);

		$this->results = array();

		$this->parse($json);
		return true;
	}

	private function parse($json)
	{
		if (is_array($json)) {
			foreach ($json as $item) {
				$this->parse($item);
			}
		} else {
			$json = (array)$json;
		}

		foreach ($json as $tablename => $data) {
			if (!is_array($data)) {
				$this->parse($data);
			} else {
				$table = Inflector::tableize($tablename);
				$table = TableRegistry::get($table);
				foreach ($data as $record) {
					$record = (array)$record;
					$new = $table->import($record);
					$result = ['table' => Inflector::humanize($tablename), 'record' => $new->import_name, 'status' => $new->import_action, 'errors' => $new->import_errors];
					$this->results[] = $result;
				}
			}
		}
	}
}
