<?php

namespace App\Model\Table;

use Cake\Validation\Validator;

class CareersTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->hasMany('Characters');
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

    /**
     * Get the list of fields used for the export functionality.
     * @return Query
     */
    public function export() {
        return $this
                        ->find()
                        ->contain('Sources')
                        ->select(['name', 'Sources.name']);
    }

}
