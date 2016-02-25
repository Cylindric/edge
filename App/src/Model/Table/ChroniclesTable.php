<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class ChroniclesTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->addBehavior('Timestamp');
        $this->addBehavior('Ceeram/Blame.Blame');

        $this->belongsTo('Characters');
        $this->belongsTo('Groups');

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

        return $validator;
    }

    /**
     * @internal
     * @param RulesChecker $rules
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        return $rules;
    }

    /**
     * Get the list of Chronicles visible to the specified user for the specified group.
     * @param int $groupId
     * @param int $userId
     * @return Query The results Query
     */
    public function getVisibleForGroup($groupId, $userId) {
        $chronicles = $this
                ->findByGroupId((int) $groupId)
                ->where(['OR' => [
                ['published' => true],
                ['created_by' => (int) $userId]],
        ]);
        return $chronicles;
    }

}
