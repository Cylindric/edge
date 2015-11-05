<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator->notEmpty('email', 'An email address is required');

        $validator
            ->notEmpty('password', 'A password is required')
            ->add('password', 'custom', [
                'rule' => [$this, 'matchPasswordsValidator'],
                'message' => 'Passwords do not match',
            ])
        ;

        $validator->notEmpty('role', 'A role is required');

        $validator->add('role', 'inList', [
            'rule' => ['inList', ['admin', 'user']],
            'message' => 'Please enter a valid role',
        ]);

        return $validator;
    }

    public function checkLogin($email, $hash)
    {
        $user = $this->find()->where(['email' => $email], ['password' => $hash])->first()->toArray();

        if ($user) {
            $this->data = $user;
            $this->id = $user['id'];
            return true;
        }

        return false;
    }

    public function matchPasswordsValidator($data, $context)
    {
        if ($data == $context['data']['confirm_password']) {
            return true;
        } else {
            return false;
        }
    }

}