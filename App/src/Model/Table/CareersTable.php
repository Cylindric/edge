<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

class CareersTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->hasMany('Characters');
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
            ->contain('Sources')
            ->select(['name', 'Sources.name']);
    }
}
