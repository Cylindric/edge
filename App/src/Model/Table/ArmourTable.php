<?php

namespace App\Model\Table;

use App\Model\Entity\Weapon;
use Cake\Validation\Validator;

class ArmourTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('armour');
        $this->addBehavior('Timestamp');
        $this->hasMany('CharactersArmour');
        $this->belongsToMany('Characters', ['through' => 'CharactersArmour']); // Specify the join-table name because by convention it should be called ArmourCharacters
        $this->belongsTo('Sources');
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
                        ->select(['name', 'defence', 'soak', 'encumbrance', 'rarity', 'hp', 'value', 'restricted', 'Sources.name']);
    }

}
