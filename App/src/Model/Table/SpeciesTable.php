<?php

namespace App\Model\Table;

use Cake\Validation\Validator;

class SpeciesTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->displayField('name');
        $this->BelongsTo('Sources');
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

        return $validator;
    }

}
