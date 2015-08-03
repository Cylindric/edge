<?php
namespace App\Model\Table;

use App\Model\Entity\Stat;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stats Model
 *
 * @property \Cake\ORM\Association\HasMany $Growth
 * @property \Cake\ORM\Association\HasMany $Skills
 */
class StatsTable extends Table
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

        $this->table('stats');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->hasMany('Skills', [
            'foreignKey' => 'stat_id'
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
