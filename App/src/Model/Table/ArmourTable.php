<?php
namespace App\Model\Table;

use App\Model\Entity\Weapon;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArmourTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('armour');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('CharactersArmour');
        $this->belongsToMany('Characters');
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

}
