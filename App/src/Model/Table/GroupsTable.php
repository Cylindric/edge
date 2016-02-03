<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class GroupsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('groups');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasMany('CharactersGroups');
        $this->hasMany('GroupsUsers');
        $this->belongsToMany('Users');
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

        return $validator;
    }

    public function isOwnedBy($groupId, $userId)
    {
        $gt = TableRegistry::get('GroupsUsers');
        return $gt->exists(['group_id' => $groupId, 'user_id' => $userId, 'gm' => true]);
    }
}
