<?php
namespace App\Model\Table;

use App\Model\Entity\Weapon;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RanksTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('ranks');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('rank', 'valid', ['rule' => 'numeric'])
            ->requirePresence('rank', 'create')
            ->notEmpty('rank');

        return $validator;
    }

}
