<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Chronicle extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function canEdit($user_id, $gm_id = 0)
    {
        // Can be edited by the creator
        if ($user_id == $this->created_by) {
            return true;
        }

        // Can be edited by the GM
        if (($gm_id != 0) && ($gm_id == $user_id)) {
            return true;
        }

        return false;
    }
}
