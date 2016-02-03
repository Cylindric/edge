<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Xp extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function IsLocked($user_id, $gm_id = 0)
    {
        // Allow editing if the User created this record
        if ($user_id == $this->created_by) {
            return false;
        }

        // Can be edited by the GM
        if (($gm_id != 0) && ($gm_id == $user_id)) {
            return false;
        }

        return true;
    }
}
