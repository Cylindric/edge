<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Please enter a valid role'
            ]);
    }

    public function checkLogin($username, $hash)
    {
        $user = $this->find()->where(['username' => $username], ['password' => $hash])->first()->toArray();

        if ($user) {
            $this->data = $user;
            $this->id = $user['id'];
            return true;
        }

        return false;
    }


}