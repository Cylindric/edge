<?php
namespace App\Model\Table;

use App\Model\Entity\Xp;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class XpTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('xp');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Ceeram/Blame.Blame');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CreatedUser', [
            'className' => 'Users',
            'foreignKey' => 'created_by',
        ]);
        $this->belongsTo('ModifyUser', [
            'className' => 'Users',
            'foreignKey' => 'modified_by',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('value', 'valid', ['rule' => 'numeric'])
            ->requirePresence('value', 'create')
            ->notEmpty('value');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['character_id'], 'Characters'));
        $rules->add($rules->existsIn(['created_by'], 'Users'));
        $rules->add($rules->existsIn(['modified_by'], 'Users'));
        return $rules;
    }

}
