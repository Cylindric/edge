<?php
namespace App\Model\Table;

use App\Model\Entity\Stat;
use Cake\Validation\Validator;

class StatsTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->displayField('name');
        $this->hasMany('Skills', [
            'foreignKey' => 'stat_id'
        ]);
    }

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
