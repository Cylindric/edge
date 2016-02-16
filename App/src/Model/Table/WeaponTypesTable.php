<?php
namespace App\Model\Table;

use App\Model\Entity\WeaponType;
use Cake\Validation\Validator;

class WeaponTypesTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->displayField('name');
        $this->addBehavior('Timestamp');
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
