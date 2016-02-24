<?php

namespace App\Model\Table;

use Cake\Validation\Validator;

class RanksTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);
    }

    /**
     * @internal
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->add('rank', 'valid', ['rule' => 'numeric'])
                ->requirePresence('rank', 'create')
                ->notEmpty('rank');

        return $validator;
    }

}
