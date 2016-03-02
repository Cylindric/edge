<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * @property-write string $password The specified password will be hashed before being set.
 * @property-read bool $can_add_data True if the current user can add new Data records.
 * @property-read bool $is_admin True if the current user is a global admin.
 */
class User extends Entity
{
    /**
     * @internal
     * @var array
     * @see http://book.cakephp.org/3.0/en/orm/entities.html#mass-assignment CakePHP Documentation
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
    
    /**
     * Properties that will not be serialised out.
     * @internal
     * @var array
     * @see http://book.cakephp.org/3.0/en/orm/entities.html#hiding-properties CakePHP Documentation
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * Virtual Fields accessor for `password`.
     * @internal
     * @param string $password unhashed password
     * @return string hashed password
     */
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
    
    /**
     * Virtual Fields accessor for `can_add_data`.
     * @internal
     * @return bool
     */
    public function _getCanAddData()
    {
        return $this->is_admin || $this->rank >= 1000;
    }

    /**
     * Virtual Fields accessor for `is_admin`.
     * @internal
     * @return bool
     */
    public function _getIsAdmin()
    {
        return $this->role == 'admin';
    }
}