<?php
namespace App\Model\Table;

use App\Model\Entity\CharactersTalent;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CharactersArmourTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('characters_armour');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Armour', [
            'foreignKey' => 'armour_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['character_id'], 'Characters'));
        $rules->add($rules->existsIn(['armour_id'], 'Armour'));
        return $rules;
    }
}
