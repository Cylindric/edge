<?php
namespace App\Model\Table;

use App\Model\Entity\Weapon;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class WeaponsTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->displayField('name');
        $this->addBehavior('Timestamp');
        $this->belongsTo('WeaponTypes', [
            'foreignKey' => 'weapon_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Skills', [
            'foreignKey' => 'skill_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Ranges', [
            'foreignKey' => 'range_id',
            'joinType' => 'INNER'
        ]);
        $this->BelongsTo('Sources');
        $this->hasMany('CharactersWeapons');
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
            ->add('damage', 'valid', ['rule' => 'numeric'])
            ->requirePresence('damage', 'create')
            ->notEmpty('damage');

        $validator
            ->add('crit', 'valid', ['rule' => 'numeric'])
            ->requirePresence('crit', 'create')
            ->notEmpty('crit');

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

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['weapon_type_id'], 'WeaponTypes'));
        $rules->add($rules->existsIn(['skill_id'], 'Skills'));
        $rules->add($rules->existsIn(['range_id'], 'Ranges'));
        return $rules;
    }

    public function export()
    {
        return $this
            ->find()
            ->contain(['WeaponTypes', 'Skills', 'Ranges', 'Sources'])
            ->select(['name', 'encumbrance', 'rarity', 'damage', 'crit', 'hp', 'value', 'restricted', 'special', 'Skills.name', 'Ranges.name', 'WeaponTypes.name', 'Sources.name']);
    }
}
