<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ObligationsTable extends Table
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

}