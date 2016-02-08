<?php
namespace App\Model\Table;

use App\Model\Entity\Weapon;
use Cake\Validation\Validator;

class ArmourTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('armour');
        $this->addBehavior('Timestamp');
        $this->hasMany('CharactersArmour');
        $this->belongsToMany('Characters');
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
            ->add('defence', 'valid', ['rule' => 'numeric'])
            ->requirePresence('defence', 'create')
            ->notEmpty('defence');

        $validator
            ->add('soak', 'valid', ['rule' => 'numeric'])
            ->requirePresence('soak', 'create')
            ->notEmpty('soak');

        $validator
            ->add('hp', 'valid', ['rule' => 'numeric'])
            ->requirePresence('hp', 'create')
            ->notEmpty('hp');

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

    public function export()
    {
        return $this
            ->find()
            ->contain('Sources')
            ->select(['name', 'defence', 'soak', 'encumbrance', 'rarity', 'hp', 'value', 'restricted', 'Sources.name']);
    }
}
