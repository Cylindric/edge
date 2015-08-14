<?php
namespace App\Model\Table;

use App\Model\Entity\Talent;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class GroupsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('groups');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->BelongsToMany('Characters', [
            'through' => 'CharactersGroups'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
