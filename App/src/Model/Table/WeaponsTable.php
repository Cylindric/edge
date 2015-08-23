<?php
namespace App\Model\Table;

use App\Model\Entity\Weapon;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Weapons Model
 *
 * @property \Cake\ORM\Association\BelongsTo $WeaponTypes
 * @property \Cake\ORM\Association\BelongsTo $Skills
 * @property \Cake\ORM\Association\BelongsTo $Ranges
 */
class WeaponsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('weapons');
        $this->displayField('name');
        $this->primaryKey('id');
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
        $this->hasMany('CharactersWeapons');
        $this->belongsToMany('Characters');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['weapon_type_id'], 'WeaponTypes'));
        $rules->add($rules->existsIn(['skill_id'], 'Skills'));
//        $rules->add($rules->existsIn(['range_id'], 'Ranges'));
        return $rules;
    }
}
