<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SlackTable extends Table {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->addBehavior('Timestamp');
    }

    /**
     * @internal
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('entity', 'An entity is required')
                        ->notEmpty('entity_id', 'An entity id is required')
        ;
    }

}
