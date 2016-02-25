<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class CharactersGroupsTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('characters_groups');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
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

        return $validator;
    }

    /**
     * @internal
     * @param RulesChecker $rules
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['character_id'], 'Characters'));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        return $rules;
    }

}
