<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class v001 extends AbstractMigration
{
    public function up()
    {
        // leaf-tables depend on nothing else
        $this->createTableCareers();
        $this->createTableGroups();
        $this->createTableNotes();
        $this->createTableRanges();
        $this->createTableSlack();
        $this->createTableSpecies();
        $this->createTableStats();
        $this->createTableTalents();
        $this->createTableUsers();
        $this->createTableWeaponTypes();
		
        // these tables depend on the above tables in some way
        $this->createTableSpecialisations(); // requires careers
        $this->createTableSkills(); // requires Stats
        $this->createTableWeapons(); // requires Ranges, Skills
        $this->createTableCharacters(); // requires Careers, Groups, Specialisations, Species, Users
        $this->createTableCharactersSkills(); // requires Characters, Skills
        $this->createTableCharactersTalents(); // requires Characters, Talents
        $this->createTableCharactersNotes(); // requires Characters, Notes
        $this->createTableCharactersWeapons(); // requires Characters, Weapons
        $this->createTableObligations(); // requires Characters
    }

    function createTableCareers()
    {
        $this->table('careers')
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->create();
    }

    function createTableCharacters()
    {
        $table = $this->table('characters');
        $table
            ->addColumn('user_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('species_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('group_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('career_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('specialisation_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('xp', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
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
            ->addColumn('credits', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('soak', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('stat_br', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_ag', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_int', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_cun', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_will', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_pr', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('wounds', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('strain', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('defence_ranged', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('defence_melee', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('species_id', 'species', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('group_id', 'groups', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('career_id', 'careers', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('specialisation_id', 'specialisations', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }

    function createTableCharactersNotes()
    {
        $table = $this->table('characters_notes');
        $table->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('note_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('note_id', 'notes', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }

    function createTableCharactersTalents()
    {
        $table = $this->table('characters_talents');
        $table
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('talent_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('rank', 'integer', ['default' => 1, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('talent_id', 'talents', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }

    function createTableCharactersWeapons()
    {
        $table = $this->table('characters_weapons');
        $table->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('weapon_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('quantity', 'integer', ['default' => 1, 'limit' => 11, 'null' => false])
            ->addColumn('equipped', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('weapon_id', 'weapons', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }

    function createTableGroups()
    {
        $this
            ->table('groups')
            ->addColumn('name', 'string', ['default' => null, 'limit' => 100, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();
    }

    function createTableNotes()
    {
        $table = $this->table('notes');
        $table
            ->addColumn('note', 'text', ['default' => null, 'null' => false])
            ->addColumn('private', 'boolean', ['default' => true, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();
    }

    function createTableObligations()
    {
        $this->table('obligations')
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('value', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('type', 'string', ['default' => '', 'limit' => 45, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }

    function createTableRanges()
    {
        $table = $this->table('ranges');
        $table
            ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();

        $table = TableRegistry::get('Ranges');
        $data = [
            ['name' => 'Engaged'],
            ['name' => 'Short'],
            ['name' => 'Medium'],
            ['name' => 'Long'],
            ['name' => 'Extreme'],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }
    }

    function createTableSkills()
    {
        $table = $this->table('skills');
        $table
            ->addColumn('stat_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('skilltype_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addForeignKey('stat_id', 'stats', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }

    function createTableSlack()
    {
        $table = $this->table('slack');
        $table->addColumn('entity', 'text', ['default' => null, 'limit' => 20, 'null' => false])
            ->addColumn('entity_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('messages', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();
    }

    function createTableSpecialisations()
    {
        $this->table('specialisations')
            ->addColumn('career_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addForeignKey('career_id', 'careers', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }

    function createTableSpecies()
    {
        $table = $this->table('species');
        $table
            ->addColumn('name', 'string', ['default' => null, 'limit' => 32, 'null' => false])
            ->addColumn('class', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addColumn('base_wound', 'integer', ['default' => 10, 'limit' => 11, 'null' => false])
            ->addColumn('base_strain', 'integer', ['default' => 10, 'limit' => 11, 'null' => false])
            ->addColumn('base_xp', 'integer', ['default' => 100, 'limit' => 11, 'null' => false])
            ->addColumn('stat_br', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_ag', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_int', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_cun', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_will', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->addColumn('stat_pr', 'integer', ['default' => 2, 'limit' => 11, 'null' => false])
            ->create();
    }

    function createTableStats()
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
    }

    function createTableTalents()
    {
        $table = $this->table('talents');
        $table->addColumn('name', 'string', ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('ranked', 'boolean', ['default' => false, 'null' => false])
            ->create();
    }

    function createTableCharactersSkills()
    {
        $table = $this->table('training');
        $table
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('skill_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('level', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('career', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('skill_id', 'skills', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }

    function createTableUsers()
    {
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
    }

    function createTableWeapons()
    {
        $table = $this->table('weapons');
        $table
            ->addColumn('weapon_type_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('skill_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('range_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => false])
            ->addColumn('encumbrance', 'integer', ['default' => 0, 'null' => false])
            ->addColumn('rarity', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('damage', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('crit', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('hp', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('value', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('restricted', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('special', 'string', ['default' => '', 'limit' => 128, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('weapon_type_id', 'weapon_types', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('skill_id', 'skills', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('range_id', 'ranges', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }

    function createTableWeaponTypes()
    {
        $table = $this->table('weapon_types');
        $table
            ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();

        $table = TableRegistry::get('WeaponTypes');
        $data = [
            ['name' => 'Energy Weapons'],
            ['name' => 'Slugthrowers'],
            ['name' => 'Thrown Weapons'],
            ['name' => 'Explosives and Other Weapons'],
            ['name' => 'Brawling Weapons'],
            ['name' => 'Melee Weapons'],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }
    }
}
