<?php

namespace App\Model\Table;

use Cake\Validation\Validator;

class TalentsTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->displayField('name');
        $this->addBehavior('Timestamp');
        $this->BelongsTo('Sources');
        $this->BelongsToMany('Characters', [
            'through' => 'CharactersTalents'
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
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->add('ranked', 'valid', ['rule' => 'boolean']);

        return $validator;
    }

}
