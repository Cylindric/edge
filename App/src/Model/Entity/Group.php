<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Group Entity.
 */
class Group extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    /**
     * Can the specified User edit this Group?
     * 
     * @param User $user
     * @return boolean true if allowed; else false.
     */
    public function IsEditableByUser($user) {
        return TableRegistry::get('GroupsUsers')
                        ->exists(['group_id' => $this->id, 'user_id' => $user->id, 'gm' => true]);
    }

    /**
     * Can the specified User add Chronicles to this Group?
     * 
     * @param User $user
     * @return boolean true if allowed; else false.
     */
    public function UserCanAddChronicle($user) {
        if ($this->IsEditableByUser($user)) {
            return true;
        }

        $userCharacters = TableRegistry::get('CharactersGroups')
                ->find()
                ->contain(['Characters'])
                ->where(['group_id' => $this->id])
                ->andWhere(['Characters.user_id' => $user->id])
                ->select(['group_id'])
                ->count();

        if ($userCharacters > 0) {
            return true;
        }

        return false;
    }

    public function PreSerialise($user) {
        $this->is_editable = $this->IsEditableByUser($user);
    }

}
