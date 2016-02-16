<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AppTable extends Table
{
    public function import($record)
    {
        // Populate the linked data
        if (array_key_exists('source', $record)) {
            $fk = $this->Sources->findByName($record['source']->name)->first();
            $record['source_id'] = $fk->id;
        }
        if (array_key_exists('range', $record)) {
            $fk = $this->Ranges->findByName($record['range']->name)->first();
            $record['range_id'] = $fk->id;
        }
        if (array_key_exists('weapon_type', $record)) {
            $fk = $this->WeaponTypes->findByName($record['weapon_type']->name)->first();
            $record['weapon_type_id'] = $fk->id;
        }
        if (array_key_exists('item_type', $record)) {
            $fk = $this->ItemTypes->findByName($record['item_type']->name)->first();
            $record['item_type_id'] = $fk->id;
        }
        if (array_key_exists('stat', $record)) {
            $fk = $this->Stats->findByName($record['stat']->name)->first();
            $record['stat_id'] = $fk->id;
        }
        if (array_key_exists('career', $record)) {
            $fk = $this->Careers->findByName($record['career']->name)->first();
            $record['career_id'] = $fk->id;
        }
        if (array_key_exists('skill', $record)) {
            $fk = $this->Skills->findByName($record['skill']->name)->first();
            $record['skill_id'] = $fk->id;
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
