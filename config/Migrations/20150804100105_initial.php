<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Initial extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('stats');
        $table
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addColumn('code', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->create();

        $table = TableRegistry::get('Stats');
        $data = [
            ['name' => 'Brawn', 'code' => 'br'],
            ['name' => 'Agility', 'code' => 'ag'],
            ['name' => 'Intellect', 'code' => 'int'],
            ['name' => 'Cunning', 'code' => 'cun'],
            ['name' => 'Willpower', 'code' => 'will'],
            ['name' => 'Presence', 'code' => 'pr']
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }


        $table = $this->table('skills');
        $table
            ->addColumn('stat_id', 'integer', ['default' => null, 'limit' => 10, 'null' => false])
            ->addColumn('skilltype_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addForeignKey('stat_id', 'stats', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
            ->create();

        $table = TableRegistry::get('Skills');
        $data = [
            ['stat_id' => '3', 'skilltype_id' => '1', 'name' => 'Astrogation'],
            ['stat_id' => '1', 'skilltype_id' => '1', 'name' => 'Athletics'],
            ['stat_id' => '6', 'skilltype_id' => '1', 'name' => 'Charm'],
            ['stat_id' => '5', 'skilltype_id' => '1', 'name' => 'Coercion'],
            ['stat_id' => '3', 'skilltype_id' => '1', 'name' => 'Computers'],
            ['stat_id' => '6', 'skilltype_id' => '1', 'name' => 'Cool'],
            ['stat_id' => '2', 'skilltype_id' => '1', 'name' => 'Coordination'],
            ['stat_id' => '4', 'skilltype_id' => '1', 'name' => 'Deception'],
            ['stat_id' => '5', 'skilltype_id' => '1', 'name' => 'Discipline'],
            ['stat_id' => '6', 'skilltype_id' => '1', 'name' => 'Leadership'],
            ['stat_id' => '3', 'skilltype_id' => '1', 'name' => 'Mechanics'],
            ['stat_id' => '3', 'skilltype_id' => '1', 'name' => 'Medicine'],
            ['stat_id' => '6', 'skilltype_id' => '1', 'name' => 'Negotiation'],
            ['stat_id' => '4', 'skilltype_id' => '1', 'name' => 'Perception'],
            ['stat_id' => '2', 'skilltype_id' => '1', 'name' => 'Piloting - Planetary'],
            ['stat_id' => '2', 'skilltype_id' => '1', 'name' => 'Piloting - Space'],
            ['stat_id' => '1', 'skilltype_id' => '1', 'name' => 'Resilience'],
            ['stat_id' => '4', 'skilltype_id' => '1', 'name' => 'Skulduggery'],
            ['stat_id' => '2', 'skilltype_id' => '1', 'name' => 'Stealth'],
            ['stat_id' => '4', 'skilltype_id' => '1', 'name' => 'Streetwise'],
            ['stat_id' => '4', 'skilltype_id' => '1', 'name' => 'Survival'],
            ['stat_id' => '5', 'skilltype_id' => '1', 'name' => 'Vigilance'],
            ['stat_id' => '1', 'skilltype_id' => '2', 'name' => 'Brawl'],
            ['stat_id' => '2', 'skilltype_id' => '2', 'name' => 'Gunnery'],
            ['stat_id' => '1', 'skilltype_id' => '2', 'name' => 'Melee'],
            ['stat_id' => '2', 'skilltype_id' => '2', 'name' => 'Ranged - Light'],
            ['stat_id' => '2', 'skilltype_id' => '2', 'name' => 'Ranged - Heavy'],
            ['stat_id' => '1', 'skilltype_id' => '2', 'name' => 'Lightsaber'],
            ['stat_id' => '3', 'skilltype_id' => '3', 'name' => 'Core Worlds'],
            ['stat_id' => '3', 'skilltype_id' => '3', 'name' => 'Education'],
            ['stat_id' => '3', 'skilltype_id' => '3', 'name' => 'Lore'],
            ['stat_id' => '3', 'skilltype_id' => '3', 'name' => 'Outer Rim'],
            ['stat_id' => '3', 'skilltype_id' => '3', 'name' => 'Underworld'],
            ['stat_id' => '3', 'skilltype_id' => '3', 'name' => 'Warfare'],
            ['stat_id' => '3', 'skilltype_id' => '3', 'name' => 'Xenology']
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }


        $table = $this->table('users');
        $table
            ->addColumn('username', 'string', ['default' => null, 'limit' => 50, 'null' => true])
            ->addColumn('password', 'string', ['default' => null, 'limit' => 255, 'null' => true])
            ->addColumn('role', 'string', ['default' => null, 'limit' => 20, 'null' => true])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();

        $table = TableRegistry::get('Users');
        $data = [
            ['username' => 'Admin', 'password' => 'admin', 'role' => 'admin']
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }


        $table = $this->table('species');
        $table
            ->addColumn('name', 'string', ['default' => null, 'limit' => 32, 'null' => false])
            ->addColumn('class', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addColumn('base_wound', 'integer', ['default' => 10, 'limit' => 10, 'null' => false])
            ->addColumn('base_strain', 'integer', ['default' => 10, 'limit' => 10, 'null' => false])
            ->addColumn('base_xp', 'integer', ['default' => 100, 'limit' => 10, 'null' => false])
            ->addColumn('stat_br', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_ag', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_int', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_cun', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_will', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_pr', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->create();

        $table = TableRegistry::get('Species');
        $data = [
            ['name' => 'Human', 'class' => 'Human', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Droid', 'class' => 'SpeciesBase', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 175, 'stat_br' => 1, 'stat_ag' => 1, 'stat_int' => 1, 'stat_cun' => 1, 'stat_will' => 1, 'stat_pr' => 1],
            ['name' => 'Wookiee', 'class' => 'SpeciesBase', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Twi\'Lek', 'class' => 'SpeciesBase', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Bothan', 'class' => 'SpeciesBase', 'base_wound' => 10, 'base_strain' => 11, 'base_xp' => 100, 'stat_br' => 1, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Rodian', 'class' => 'SpeciesBase', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Trandoshan', 'class' => 'SpeciesBase', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Gand', 'class' => 'SpeciesBase', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 3, 'stat_pr' => 2],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }

        $table = $this->table('characters');
        $table
            ->addColumn('user_id', 'integer', ['default' => null, 'limit' => 10, 'null' => false])
            ->addColumn('species_id', 'integer', ['default' => null, 'limit' => 10, 'null' => false])
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addColumn('gender', 'string', ['default' => null, 'limit' => 45, 'null' => true])
            ->addColumn('age', 'string', ['default' => null, 'limit' => 45, 'null' => true])
            ->addColumn('height', 'string', ['default' => null, 'limit' => 45, 'null' => true])
            ->addColumn('weight', 'string', ['default' => null, 'limit' => 45, 'null' => true])
            ->addColumn('hair_colour', 'string', ['default' => null, 'limit' => 45, 'null' => true])
            ->addColumn('eye_colour', 'string', ['default' => null, 'limit' => 45, 'null' => true])
            ->addColumn('build', 'string', ['default' => null, 'limit' => 45, 'null' => true])
            ->addColumn('home_planet', 'string', ['default' => null, 'limit' => 45, 'null' => true])
            ->addColumn('notable_features', 'string', ['default' => null, 'limit' => 45, 'null' => true])
            ->addColumn('stat_br', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_ag', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_int', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_cun', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_will', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addColumn('stat_pr', 'integer', ['default' => 2, 'limit' => 10, 'null' => false])
            ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
            ->addForeignKey('species_id', 'species', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
            ->create();

        $table = $this->table('training');
        $table
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 10, 'null' => false])
            ->addColumn('skill_id', 'integer', ['default' => null, 'limit' => 10, 'null' => false])
            ->addColumn('level', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
            ->addForeignKey('skill_id', 'skills', 'id', ['update' => 'NO_ACTION', 'delete' => 'NO_ACTION'])
            ->create();
    }
}
