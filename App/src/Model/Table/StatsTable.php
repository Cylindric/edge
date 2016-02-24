<?php

namespace App\Model\Table;

use Cake\Validation\Validator;

class StatsTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->displayField('name');
        $this->hasMany('Skills', [
            'foreignKey' => 'stat_id'
        ]);
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
                ->allowEmpty('name');

        return $validator;
    }

}
