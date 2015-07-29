<?php
namespace App\Model\Table;

use App\Model\Entity\Characteristic;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Characteristics Model
 *
 * @property \Cake\ORM\Association\HasMany $Growth
 * @property \Cake\ORM\Association\HasMany $Skills
 */
class CharacteristicsTable extends Table
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

        $this->table('characteristics');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->hasMany('Growth', [
            'foreignKey' => 'characteristic_id'
        ]);
        $this->hasMany('Skills', [
            'foreignKey' => 'characteristic_id'
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
            ->allowEmpty('name');

        return $validator;
    }
}
