<?php
namespace App\Model\Table;

use App\Model\Entity\Item;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class ItemsTable extends AppTable
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Timestamp');
        $this->belongsTo('ItemTypes', [
            'foreignKey' => 'item_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Sources');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('encumbrance', 'valid', ['rule' => 'numeric'])
            ->requirePresence('encumbrance', 'create')
            ->notEmpty('encumbrance');

        $validator
            ->add('rarity', 'valid', ['rule' => 'numeric'])
            ->requirePresence('rarity', 'create')
            ->notEmpty('rarity');

        $validator
            ->add('value', 'valid', ['rule' => 'numeric'])
            ->requirePresence('value', 'create')
            ->notEmpty('value');

        $validator
            ->add('restricted', 'valid', ['rule' => 'boolean'])
            ->requirePresence('restricted', 'create')
            ->notEmpty('restricted');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['item_type_id'], 'ItemTypes'));
        return $rules;
    }

    public function export()
    {
        return $this
            ->find()
            ->contain(['ItemTypes', 'Sources'])
            ->select(['name', 'encumbrance', 'rarity', 'value', 'restricted', 'ItemTypes.name', 'Sources.name']);
    }
}
