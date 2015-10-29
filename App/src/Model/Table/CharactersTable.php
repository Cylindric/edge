<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class CharactersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->displayField('name');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Species');
        $this->belongsTo('Groups');
        $this->belongsTo('Specialisations');
        $this->belongsTo('Careers');
        $this->belongsTo('Users');

        $this->hasMany('CharactersArmour');
        $this->hasMany('CharactersTalents');
        $this->hasMany('CharactersWeapons');
        $this->hasMany('CharactersSkills');
        $this->hasMany('CharactersItems');
        $this->hasMany('Obligations');
        $this->hasMany('Xp');

        $this->belongsToMany('Armour', ['through' => 'CharactersArmour']); // Specify the join-table name because by convention it should be called ArmourCharacters
        $this->belongsToMany('Items');
        $this->belongsToMany('Skills');
        $this->belongsToMany('Talents');
        $this->belongsToMany('Notes');
        $this->belongsToMany('Weapons');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['species_id'], 'Species'));
        return $rules;
    }

    public function isOwnedBy($characterId, $userId)
    {
        // The character's actual owner is obviously an owner
        if ($this->exists(['id' => $characterId, 'user_id' => $userId])) {
            return true;
        }

        // If the character is in any groups, those groups' GMs are also granted Owner status
        $groups = TableRegistry::get('Groups')
            ->find()
            ->select(['GroupsUsers.id'])
            ->matching('GroupsUsers', function ($q) use ($userId) {
                return $q->where(['GroupsUsers.user_id' => $userId]);
            })
            ->hydrate(false)
            ->count();

        if ($groups > 0) {
            return true;
        }

        return false;
    }

}
