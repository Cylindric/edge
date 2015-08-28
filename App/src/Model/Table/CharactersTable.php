<?php
namespace App\Model\Table;

use App\Model\Entity\Character;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CharactersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->displayField('name');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Species');
        $this->belongsTo('Groups');
        $this->belongsTo('Specialisations');
        $this->belongsTo('Careers');
        $this->belongsTo('Users');

        $this->hasMany('CharactersArmour');
        $this->hasMany('CharactersTalents');
        $this->hasMany('CharactersWeapons');
        $this->hasMany('CharactersSkills');
        $this->hasMany('CharactersItems');
        $this->hasMany('Obligations');

        $this->belongsToMany('Armour', ['through' => 'CharactersArmour']);
        $this->belongsToMany('Items');
        $this->belongsToMany('Skills');
        $this->belongsToMany('Talents');
        $this->belongsToMany('Notes');
        $this->belongsToMany('Weapons');
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

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['species_id'], 'Species'));
        return $rules;
    }

    public function beforeSave($event, $entity, $options)
    {
        $old = $entity->getOriginal('credits');
        $new = $entity->credits;
        if ($old != $new) {
            // Remove any pretty formatting
            $new = trim($new);
            $new = str_replace(',', '', $new);

            // If it starts with a maths symbol, calculate based on that
            if (preg_match('/([\+\-\*\/])(\d+)/', $new, $matches) !== FALSE) {
                if (!empty($matches)) {
                    $operator = $matches[1];

                    switch ($operator) {
                        case '+':
                            $new = $old + $matches[2];
                            break;
                        case '-':
                            $new = $old - $matches[2];
                            break;
                        case '*':
                            $new = $old * $matches[2];
                            break;
                        case '/':
                            $new = $old / $matches[2];
                            break;
                    }
                }
            }

            $entity->credits = $new;
        }
    }

    public function isOwnedBy($characterId, $userId)
    {
        return $this->exists(['id' => $characterId, 'user_id' => $userId]);
    }

}
