<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Chronicle extends Entity {

    /**
     * @internal
     * @var array 
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function canEdit($user, $gm_id = 0) {
        // Can be edited by the creator
        if ($user->id == $this->created_by) {
            return true;
        }

        // Can be edited by the GM
        if (($gm_id != 0) && ($gm_id == $user->id)) {
            return true;
        }

        return false;
    }

}
