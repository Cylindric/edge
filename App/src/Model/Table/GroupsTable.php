<?php

namespace App\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

class GroupsTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->addBehavior('Timestamp');

        $this->hasMany('CharactersGroups');
        $this->hasMany('GroupsUsers');
        $this->belongsToMany('Users');
        $this->belongsToMany('Characters');
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
     * Returns true if the supplied user owns the specified group.
     * 
     * @param int $groupId
     * @param int $userId
     * @return boolean
     * 
     */
    public function isOwnedBy($groupId, $userId) {
        $gt = TableRegistry::get('GroupsUsers');
        return $gt->exists(['group_id' => $groupId, 'user_id' => $userId, 'gm' => true]);
    }

    /**
     * Get the User that is the GM for the specified Group.
     * @param int $groupId
     * @return App\Model\Entity\User
     */
    public function getGm($groupId) {
        $gm = $this
                ->GroupsUsers
                ->find()
                ->contain(['Users'])
                ->where(['group_id' => $groupId, 'gm' => true])
                ->first();

        return $gm->user;
    }

}
