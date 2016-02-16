<?php
namespace App\Model\Table;

use App\Model\Entity\Species;
use Cake\Validation\Validator;

class SpeciesTable extends AppTable
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->displayField('name');
        $this->BelongsTo('Sources');
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
