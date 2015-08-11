<?php
namespace App\Model\Table;

use App\Model\Entity\Character;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Characters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Species
 * @property \Cake\ORM\Association\HasMany $Growth
 * @property \Cake\ORM\Association\HasMany $Training
 */
class CharactersTable extends Table
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

		$this->table('characters');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->belongsTo('Species', [
			'foreignKey' => 'species_id',
			'joinType' => 'INNER'
		]);
		$this->hasMany('Training', [
			'foreignKey' => 'character_id'
		]);
		$this->hasMany('CharactersTalents', [
			'foreignKey' => 'character_id'
		]);
		$this->BelongsToMany('Talents', [
			'through' => 'CharactersTalents'
		]);
		$this->BelongsToMany('Notes', [
			'through' => 'CharactersNotes'
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

		return $validator;
	}

	/**
	 * Returns a rules checker object that will be used for validating
	 * application integrity.
	 *
	 * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
	 * @return \Cake\ORM\RulesChecker
	 */
	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->existsIn(['species_id'], 'Species'));
		return $rules;
	}

	public function isOwnedBy($characterId, $userId)
	{
		return $this->exists(['id' => $characterId, 'user_id' => $userId]);
	}

	public function afterSaveCommit($event, $entity, $options)
	{
	}
}
