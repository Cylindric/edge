<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class SpecialisationsTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->displayField('name');
        $this->hasMany('Characters');
        $this->BelongsTo('Careers');
        $this->BelongsTo('Sources');
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

    public function export()
    {
        return $this
            ->find()
            ->contain(['Careers', 'Sources'])
            ->select(['name', 'Careers.name', 'Sources.name']);
    }
}
