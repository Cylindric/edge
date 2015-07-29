<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Growth Entity.
 */
class Growth extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
