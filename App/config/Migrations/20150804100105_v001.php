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

        $table = TableRegistry::get('Careers');
        $data = [
            ['id' => 1, 'name' => 'Bounty Hunter'],
            ['id' => 2, 'name' => 'Colonist'],
            ['id' => 3, 'name' => 'Explorer'],
            ['id' => 4, 'name' => 'Hired Gun'],
            ['id' => 5, 'name' => 'Smuggler'],
            ['id' => 6, 'name' => 'Technician'],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }
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

        $table = TableRegistry::get('Specialisations');
        $data = [
            ['name' => 'Assassin', 'career_id' => 1],
            ['name' => 'Gadgeteer', 'career_id' => 1],
            ['name' => 'Survivalist', 'career_id' => 1],
            ['name' => 'Doctor', 'career_id' => 2],
            ['name' => 'Politico', 'career_id' => 2],
            ['name' => 'Scholar', 'career_id' => 2],
            ['name' => 'Fringer', 'career_id' => 3],
            ['name' => 'Scout', 'career_id' => 3],
            ['name' => 'Trader', 'career_id' => 3],
            ['name' => 'Bodyguard', 'career_id' => 4],
            ['name' => 'Marauder', 'career_id' => 4],
            ['name' => 'Mercenary Soldier', 'career_id' => 4],
            ['name' => 'Pilot', 'career_id' => 5],
            ['name' => 'Scoundrel', 'career_id' => 5],
            ['name' => 'Thief', 'career_id' => 5],
            ['name' => 'Mechanic', 'career_id' => 6],
            ['name' => 'Outlaw Tech', 'career_id' => 6],
            ['name' => 'Slicer', 'career_id' => 6],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }
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

        $table = TableRegistry::get('Weapons');
        $data = [
            ['name' => 'Holdout Blaster', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 5, 'crit' => 4, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 1, 'value' => 200, 'restricted' => false, 'rarity' => 4, 'special' => 'Stun setting'],
            ['name' => 'Light Blaster Pistol', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 5, 'crit' => 4, 'range_id' => 3, 'encumbrance' => 1, 'hp' => 2, 'value' => 300, 'restricted' => false, 'rarity' => 4, 'special' => 'Stun setting'],
            ['name' => 'Blaster Pistol', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 6, 'crit' => 3, 'range_id' => 3, 'encumbrance' => 1, 'hp' => 3, 'value' => 400, 'restricted' => false, 'rarity' => 6, 'special' => 'Stun setting'],
            ['name' => 'Heavy Blaster Pistol', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 7, 'crit' => 3, 'range_id' => 3, 'encumbrance' => 2, 'hp' => 3, 'value' => 700, 'restricted' => false, 'rarity' => 6, 'special' => 'Stun setting'],
            ['name' => 'Blaster Carbine', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 9, 'crit' => 3, 'range_id' => 3, 'encumbrance' => 3, 'hp' => 4, 'value' => 850, 'restricted' => false, 'rarity' => 5, 'special' => 'Stun setting'],
            ['name' => 'Blaster Rifle', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 9, 'crit' => 3, 'range_id' => 4, 'encumbrance' => 4, 'hp' => 4, 'value' => 900, 'restricted' => false, 'rarity' => 5, 'special' => 'Stun setting'],
            ['name' => 'Heavy Blaster Rifle', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 10, 'crit' => 3, 'range_id' => 4, 'encumbrance' => 6, 'hp' => 4, 'value' => 1500, 'restricted' => false, 'rarity' => 6, 'special' => 'Auto-fire. Cumbersome 3'],
            ['name' => 'Light Repeating Blaster', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 11, 'crit' => 3, 'range_id' => 4, 'encumbrance' => 7, 'hp' => 4, 'value' => 2250, 'restricted' => true, 'rarity' => 7, 'special' => 'Auto-fire, Cumbersome 4. Pierce 1'],
            ['name' => 'Heavy Repeating Blaster', 'weapon_type_id' => 1, 'skill_id' => 24, 'damage' => 15, 'crit' => 2, 'range_id' => 4, 'encumbrance' => 9, 'hp' => 4, 'value' => 6000, 'restricted' => true, 'rarity' => 8, 'special' => 'Auto-fire. Cumbersome 5, Pierce 2, Vicious 1'],
            ['name' => 'Bowcaster', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 10, 'crit' => 3, 'range_id' => 3, 'encumbrance' => 5, 'hp' => 2, 'value' => 1250, 'restricted' => false, 'rarity' => 7, 'special' => 'Cumbersome 3, Knockdown'],
            ['name' => 'Ionization Blaster', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 10, 'crit' => 5, 'range_id' => 2, 'encumbrance' => 3, 'hp' => 3, 'value' => 250, 'restricted' => false, 'rarity' => 3, 'special' => 'Disorient 5, Stun Damage (Droid only)'],
            ['name' => 'Disruptor Pistol', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 10, 'crit' => 2, 'range_id' => 2, 'encumbrance' => 2, 'hp' => 2, 'value' => 3000, 'restricted' => true, 'rarity' => 6, 'special' => 'Vicious 4'],
            ['name' => 'Disruptor Rifle', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 10, 'crit' => 2, 'range_id' => 4, 'encumbrance' => 5, 'hp' => 4, 'value' => 5000, 'restricted' => true, 'rarity' => 6, 'special' => 'Cumbersome 2, Vicious 5'],

            ['name' => 'Slugthrower Pistol', 'weapon_type_id' => 2, 'skill_id' => 26, 'damage' => 4, 'crit' => 5, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 100, 'restricted' => false, 'rarity' => 3, 'special' => ''],
            ['name' => 'Slugthrower Rifle', 'weapon_type_id' => 2, 'skill_id' => 27, 'damage' => 7, 'crit' => 5, 'range_id' => 3, 'encumbrance' => 5, 'hp' => 1, 'value' => 250, 'restricted' => false, 'rarity' => 3, 'special' => 'Cumbersome 2'],

            ['name' => 'Bola / Net', 'weapon_type_id' => 3, 'skill_id' => 26, 'damage' => 2, 'crit' => 0, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 2, 'value' => 20, 'restricted' => false, 'rarity' => 2, 'special' => 'Ensnare 3, Knockdown, Limited Ammo 1'],

            ['name' => 'Flame Projector', 'weapon_type_id' => 4, 'skill_id' => 27, 'damage' => 8, 'crit' => 3, 'range_id' => 2, 'encumbrance' => 6, 'hp' => 2, 'value' => 1000, 'restricted' => false, 'rarity' => 6, 'special' => 'Burn 3, Blast 8'],
            ['name' => 'Missile Tube', 'weapon_type_id' => 4, 'skill_id' => 24, 'damage' => 20, 'crit' => 2, 'range_id' => 5, 'encumbrance' => 7, 'hp' => 4, 'value' => 7500, 'restricted' => true, 'rarity' => 8, 'special' => 'Blast 10, Cumbersomme 3, Guided 3, Breach 1, Prepare 1, Limited Ammo 6'],
            ['name' => 'Frag Grenade', 'weapon_type_id' => 4, 'skill_id' => 26, 'damage' => 8, 'crit' => 4, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 50, 'restricted' => false, 'rarity' => 5, 'special' => 'Blast 6, Limited Ammo 1'],
            ['name' => 'Stun Grenade', 'weapon_type_id' => 4, 'skill_id' => 26, 'damage' => 18, 'crit' => 0, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 75, 'restricted' => false, 'rarity' => 4, 'special' => 'Disorient 3, Stun Damage, Blast 8, Limited Ammo 1'],
            ['name' => 'Thermal Detonator', 'weapon_type_id' => 4, 'skill_id' => 26, 'damage' => 20, 'crit' => 2, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 2000, 'restricted' => true, 'rarity' => 8, 'special' => 'Blast 15, Breach 1, Vicious 4, Limited Ammo 1'],

            ['name' => 'Brass Knuckles', 'weapon_type_id' => 5, 'skill_id' => 23, 'damage' => 1, 'crit' => 4, 'range_id' => 1, 'encumbrance' => 1, 'hp' => 0, 'value' => 25, 'restricted' => false, 'rarity' => 0, 'special' => 'Disorient 3'],
            ['name' => 'Shock Gloves', 'weapon_type_id' => 5, 'skill_id' => 23, 'damage' => 0, 'crit' => 5, 'range_id' => 1, 'encumbrance' => 0, 'hp' => 1, 'value' => 300, 'restricted' => false, 'rarity' => 2, 'special' => 'Stun 3'],

            ['name' => 'Combat Knife', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 1, 'crit' => 3, 'range_id' => 1, 'encumbrance' => 1, 'hp' => 0, 'value' => 25, 'restricted' => false, 'rarity' => 1, 'special' => ''],
            ['name' => 'Gaffi Stick', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 2, 'crit' => 3, 'range_id' => 1, 'encumbrance' => 3, 'hp' => 0, 'value' => 100, 'restricted' => false, 'rarity' => 2, 'special' => 'Defensive 1, Disorient 3'],
            ['name' => 'Force Pike', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 3, 'crit' => 2, 'range_id' => 1, 'encumbrance' => 3, 'hp' => 3, 'value' => 500, 'restricted' => false, 'rarity' => 4, 'special' => 'Pierce 2, Stun Setting'],
            ['name' => 'Lightsaber', 'weapon_type_id' => 6, 'skill_id' => 28, 'damage' => 10, 'crit' => 1, 'range_id' => 1, 'encumbrance' => 1, 'hp' => 0, 'value' => 10000, 'restricted' => true, 'rarity' => 10, 'special' => 'Breach 1, Sunder, Vicious 2'],
            ['name' => 'Truncheon', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 2, 'crit' => 5, 'range_id' => 1, 'encumbrance' => 2, 'hp' => 0, 'value' => 15, 'restricted' => false, 'rarity' => 1, 'special' => 'Disorient'],
            ['name' => 'Vibro-Ax', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 3, 'crit' => 2, 'range_id' => 1, 'encumbrance' => 4, 'hp' => 3, 'value' => 750, 'restricted' => false, 'rarity' => 5, 'special' => 'Pierce 2, Sunder, Vicious 3'],
            ['name' => 'Vibroknife', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 1, 'crit' => 2, 'range_id' => 1, 'encumbrance' => 1, 'hp' => 2, 'value' => 250, 'restricted' => false, 'rarity' => 3, 'special' => 'Pierce 2, Vicious 1'],
            ['name' => 'Vibrosword', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 2, 'crit' => 2, 'range_id' => 1, 'encumbrance' => 3, 'hp' => 5, 'value' => 750, 'restricted' => false, 'rarity' => 5, 'special' => 'Pierce 2, Vicious 1, Defensive 1'],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }
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
