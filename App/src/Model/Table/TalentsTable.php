<?php
namespace App\Model\Table;

use App\Model\Entity\Talent;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Talents Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Characters
 */
class TalentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('talents');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->BelongsToMany('Characters', [
            'through' => 'CharactersTalents'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('ranked', 'valid', ['rule' => 'boolean'])
            ->requirePresence('ranked', 'create')
            ->notEmpty('ranked');

        $validator
            ->requirePresence('activation_type', 'create')
            ->notEmpty('activation_type');

        $validator
            ->add('page', 'valid', ['rule' => 'numeric'])
            ->requirePresence('page', 'create')
            ->notEmpty('page');

        return $validator;
    }
}