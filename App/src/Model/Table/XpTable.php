<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class XpTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->addBehavior('Timestamp');
        $this->addBehavior('Ceeram/Blame.Blame');

        $this->belongsTo('Characters');
        $this->belongsTo('CreatedUser', [
            'className' => 'Users',
            'foreignKey' => 'created_by',
        ]);
        $this->belongsTo('ModifyUser', [
            'className' => 'Users',
            'foreignKey' => 'modified_by',
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
                ->add('value', 'valid', ['rule' => 'numeric'])
                ->requirePresence('value', 'create')
                ->notEmpty('value');

        return $validator;
    }

    /**
     * @internal
     * @param RulesChecker $rules
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['character_id'], 'Characters'));
        return $rules;
    }

    public function totalForCharacter($character_id) {
        $query = $this->find();
        $query
                ->where(['character_id' => $character_id])
                ->select(['total' => $query->func()->sum('value')])
                ->hydrate(false);
        $query = $query->first();

        if ($query['total'] === null) {
            $query['total'] = 0;
        }
        return $query['total'];
    }

}
