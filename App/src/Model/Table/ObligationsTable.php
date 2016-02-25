<?php

namespace App\Model\Table;

use Cake\Validation\Validator;

class ObligationsTable extends AppTable {

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
        return $validator
                        ->notEmpty('value', 'A value is required')
                        ->notEmpty('type', 'A type is required');
    }

    /**
     * Get the total Obligation for the specified character.
     * @param int $character_id
     * @return int
     */
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
