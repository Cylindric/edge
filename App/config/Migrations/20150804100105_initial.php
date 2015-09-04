<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Initial extends AbstractMigration
{
    public function up()
    {
        // leaf-tables depend on nothing else
        $this->createTableGroups();
        $this->createTableNotes();
        $this->createTableSkills();
        $this->createTableSlack();
        $this->createTableSpecies();
        $this->createTableStats();
        $this->createTableTalents();
        $this->createTableCareers();
        $this->createTableSpecialisations();
        $this->createTableWeaponTypes();
        $this->createTableRanges();

        // these tables depend on the above tables in some way
        $this->createTableWeapons();
        $this->createTableCharacters();
        $this->createTableUsers();
        $this->createTableCharactersSkills();
        $this->createTableCharactersTalents();
        $this->createTableCharactersNotes();
        $this->createTableCharactersWeapons();

        $this->createTableObligations();
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
            ->addColumn('name', ' string', ['default' => null, 'limit' => 100, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();
    }

    function createTableNotes()
    {
        $table = $this->table('notes');
        $table->addColumn('note', 'text', ['default' => null, 'null' => false])
            ->addColumn('private', 'boolean', ['default' => true, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();
    }

    function createTableObligations()
    {
        $this->table('obligations')
            ->addColumn('character_id', 'int', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('value', 'int', ['default' => 0, 'limit' => 11, 'null' => false])
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
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addColumn('career_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
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

        $table = TableRegistry::get('Species');
        $data = [
            // Core Rulebook Species
            ['name' => 'Human', 'class' => 'Human', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Droid', 'class' => 'Droid', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 175, 'stat_br' => 1, 'stat_ag' => 1, 'stat_int' => 1, 'stat_cun' => 1, 'stat_will' => 1, 'stat_pr' => 1],
            ['name' => 'Wookiee', 'class' => 'Wookiee', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 3, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 1, 'stat_pr' => 2],
            ['name' => 'Twi\'Lek', 'class' => 'Twilek', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 1, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 3],
            ['name' => 'Bothan', 'class' => 'Bothan', 'base_wound' => 10, 'base_strain' => 11, 'base_xp' => 100, 'stat_br' => 1, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 3, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Rodian', 'class' => 'Rodian', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 3, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 1, 'stat_pr' => 2],
            ['name' => 'Trandoshan', 'class' => 'Trandoshan', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 3, 'stat_ag' => 1, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Gand', 'class' => 'Gand', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 3, 'stat_pr' => 2],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }
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

        $talents = TableRegistry::get('Talents');
        $data = [
            ['name' => 'Armor Master', 'ranked' => false],
            ['name' => 'Armor Master (Improved)', 'ranked' => false],
            ['name' => 'Bacta Specialist', 'ranked' => true],
            ['name' => 'Bad Motivator', 'ranked' => false],
            ['name' => 'Balance', 'ranked' => false],
            ['name' => 'Barrage', 'ranked' => true],
            ['name' => 'Black Market Contacts', 'ranked' => true],
            ['name' => 'Blooded', 'ranked' => true],
            ['name' => 'Body Guard', 'ranked' => true],
            ['name' => 'Brace', 'ranked' => true],
            ['name' => 'Brilliant Evasion', 'ranked' => false],
            ['name' => 'Bypass Security', 'ranked' => true],
            ['name' => 'Codebreaker', 'ranked' => true],
            ['name' => 'Command', 'ranked' => true],
            ['name' => 'Confidence', 'ranked' => true],
            ['name' => 'Contraption', 'ranked' => false],
            ['name' => 'Convincing Demeanor', 'ranked' => true],
            ['name' => 'Crippling Blow', 'ranked' => false],
            ['name' => 'Dead to Rights', 'ranked' => false],
            ['name' => 'Dead to Rights (Improved)', 'ranked' => false],
            ['name' => 'Deadly Accuracy', 'ranked' => true],
            ['name' => 'Dedication', 'ranked' => true],
            ['name' => 'Defencing Driving', 'ranked' => true],
            ['name' => 'Defencive Slicing', 'ranked' => true],
            ['name' => 'Defensive Slicing (Improved)', 'ranked' => false],
            ['name' => 'Defensive Stance', 'ranked' => true],
            ['name' => 'Disorient', 'ranked' => true],
            ['name' => 'Dodge', 'ranked' => true],
            ['name' => 'Durable', 'ranked' => true],
            ['name' => 'Enduring', 'ranked' => true],
            ['name' => 'Expert Tracker', 'ranked' => true],
            ['name' => 'Familiar Suns', 'ranked' => false],
            ['name' => 'Feral Strength', 'ranked' => true],
            ['name' => 'Field Commander', 'ranked' => false],
            ['name' => 'Field Commander (Improved)', 'ranked' => false],
            ['name' => 'Fine Tuning', 'ranked' => true],
            ['name' => 'Forager', 'ranked' => false],
            ['name' => 'Force Rating', 'ranked' => true],
            ['name' => 'Frenzied Attack', 'ranked' => true],
            ['name' => 'Full Throttle', 'ranked' => false],
            ['name' => 'Full Throttle (Improved)', 'ranked' => false],
            ['name' => 'Full Throttle (Supreme)', 'ranked' => false],
            ['name' => 'Galaxy Mapper', 'ranked' => true],
            ['name' => 'Gearhead', 'ranked' => true],
            ['name' => 'Grit', 'ranked' => true],
            ['name' => 'Hard Headed', 'ranked' => true],
            ['name' => 'Hard Headed (Improved)', 'ranked' => false],
            ['name' => 'Heightened Awareness', 'ranked' => false],
            ['name' => 'Heroic Fortitude', 'ranked' => false],
            ['name' => 'Hidden Storag', 'ranked' => true],
            ['name' => 'Hold Together', 'ranked' => false],
            ['name' => 'Hunter', 'ranked' => true],
            ['name' => 'Indistinguishable', 'ranked' => true],
            ['name' => 'Insight', 'ranked' => false],
            ['name' => 'Inspiring Rhetoric', 'ranked' => false],
            ['name' => 'Inpsiring Rhetoric (Improved)', 'ranked' => false],
            ['name' => 'Inspiring Rhetoric (Supreme)', 'ranked' => false],
            ['name' => 'Intense Focus', 'ranked' => false],
            ['name' => 'Intense Presence', 'ranked' => false],
            ['name' => 'Intimidating', 'ranked' => true],
            ['name' => 'Inventor', 'ranked' => true],
            ['name' => 'Jump Up', 'ranked' => false],
            ['name' => 'Jury Rigged', 'ranked' => true],
            ['name' => 'Kill with Kindness', 'ranked' => true],
            ['name' => 'Knockdown', 'ranked' => false],
            ['name' => 'Know Somebody', 'ranked' => true],
            ['name' => 'Knowledge Specialization', 'ranked' => true],
            ['name' => 'Known Schematic', 'ranked' => false],
            ['name' => 'Let\'s Ride', 'ranked' => false],
            ['name' => 'Lethal Blows', 'ranked' => true],
            ['name' => 'Master Doctor', 'ranked' => false],
            ['name' => 'Regeneration', 'ranked' => false],
            ['name' => 'Claws', 'ranked' => false],
            ['name' => 'Master Metchant', 'ranked' => false],
            ['name' => 'Master of Shadows', 'ranked' => false],
            ['name' => 'Master Pilot', 'ranked' => false],
            ['name' => 'Master Slicer', 'ranked' => false],
            ['name' => 'Master Starhopper', 'ranked' => false],
            ['name' => 'Mental Fortress', 'ranked' => false],
            ['name' => 'Natural Brawler', 'ranked' => false],
            ['name' => 'Natural Charmer', 'ranked' => false],
            ['name' => 'Natural Doctor', 'ranked' => false],
            ['name' => 'Natural Enforcer', 'ranked' => false],
            ['name' => 'Natural Hunter', 'ranked' => false],
            ['name' => 'Natural Marksman', 'ranked' => false],
            ['name' => 'Natural Negotiator', 'ranked' => false],
            ['name' => 'Natural Outdoorsman', 'ranked' => false],
            ['name' => 'Natural Pilot', 'ranked' => false],
            ['name' => 'Natural Programmer', 'ranked' => false],
            ['name' => 'Natural Rogue', 'ranked' => false],
            ['name' => 'Natural Scholar', 'ranked' => false],
            ['name' => 'Natural Tinkerer', 'ranked' => false],
            ['name' => 'Nobody\'s Fool', 'ranked' => true],
            ['name' => 'Outdoorsman', 'ranked' => true],
            ['name' => 'Overwhelm Emotions', 'ranked' => false],
            ['name' => 'Plausible Deniability', 'ranked' => true],
            ['name' => 'Point Blank', 'ranked' => true],
            ['name' => 'Precise Aim', 'ranked' => true],
            ['name' => 'Pressure Point', 'ranked' => false],
            ['name' => 'Quick Draw', 'ranked' => false],
            ['name' => 'Quick Strike', 'ranked' => true],
            ['name' => 'Rapid Reaction', 'ranked' => true],
            ['name' => 'Rapid Recovery', 'ranked' => true],
            ['name' => 'Redundant Systems', 'ranked' => false],
            ['name' => 'Researcher', 'ranked' => true],
            ['name' => 'Resolve', 'ranked' => true],
            ['name' => 'Respected Scholar', 'ranked' => true],
            ['name' => 'Scathing Tirade', 'ranked' => false],
            ['name' => 'Scathing Tirade (Improved)', 'ranked' => false],
            ['name' => 'Scathing Tirade (Supreme)', 'ranked' => false],
            ['name' => 'Second Wind', 'ranked' => true],
            ['name' => 'Sense Danger', 'ranked' => false],
            ['name' => 'Sense Emotions', 'ranked' => false],
            ['name' => 'Shortcut', 'ranked' => true],
            ['name' => 'Side Step', 'ranked' => true],
            ['name' => 'Sixth Sense', 'ranked' => false],
            ['name' => 'Skilled Jockey', 'ranked' => true],
            ['name' => 'Skilled Slicer', 'ranked' => false],
            ['name' => 'Smooth Talker', 'ranked' => true],
            ['name' => 'Sniper Shot', 'ranked' => true],
            ['name' => 'Soft Spot', 'ranked' => false],
            ['name' => 'Solid Repairs', 'ranked' => true],
            ['name' => 'Spare Clip', 'ranked' => false],
            ['name' => 'Speaks Binary', 'ranked' => true],
            ['name' => 'Stalker', 'ranked' => true],
            ['name' => 'Steely Nerves', 'ranked' => false],
            ['name' => 'Stim Application', 'ranked' => false],
            ['name' => 'Stim Application (Improved)', 'ranked' => false],
            ['name' => 'Stim Application (Supreme)', 'ranked' => false],
            ['name' => 'Street Smarts', 'ranked' => true],
            ['name' => 'Stroke of Genius', 'ranked' => false],
            ['name' => 'Strong Armor', 'ranked' => false],
            ['name' => 'Stunning Blow', 'ranked' => false],
            ['name' => 'Stunning Blow (Improved)', 'ranked' => false],
            ['name' => 'Superior Reflexes', 'ranked' => false],
            ['name' => 'Surgeon', 'ranked' => true],
            ['name' => 'Swift', 'ranked' => false],
            ['name' => 'Targeted Blow', 'ranked' => false],
            ['name' => 'Technical Aptitude', 'ranked' => true],
            ['name' => 'Tinkerer', 'ranked' => true],
            ['name' => 'Touch of Fate', 'ranked' => false],
            ['name' => 'Toughened', 'ranked' => true],
            ['name' => 'Tricky Target', 'ranked' => false],
            ['name' => 'True Aim', 'ranked' => true],
            ['name' => 'Uncanny Reactions', 'ranked' => true],
            ['name' => 'Uncanny Senses', 'ranked' => true],
            ['name' => 'Utility Belt', 'ranked' => false],
            ['name' => 'Utinni!', 'ranked' => true],
            ['name' => 'Well Rounded', 'ranked' => true],
            ['name' => 'Wheel and Deal', 'ranked' => true],
        ];
        $data = $talents->newEntities($data);
        foreach ($data as $entity) {
            $talents->save($entity);
        }
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
            ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => false])
            ->addColumn('encumbrance', 'integer', ['default' => 0, 'null' => false])
            ->addColumn('range_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('rarity', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('damage', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('crit', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('hp', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('value', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('restricted', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('special', 'string', ['default' => '', 'limit' => 128, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('range_id', 'ranges', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('skill_id', 'skills', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('weapon_type_id', 'weapon_types', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        $table = TableRegistry::get('Weapons');
        $data = [
            ['name' => 'Holdout Blaster', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 5, 'crit' => 4, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 1, 'value' => 200, 'restricted' => false, 'rarity' => 4, 'special' => 'Stun setting'],
            ['name' => 'Light Blaster Pistol', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 5, 'crit' => 4, 'range_id' => 3, 'encumbrance' => 1, 'hp' => 2, 'value' => 300, 'restricted' => false, 'rarity' => 4, 'special' => 'Stun setting'],
            ['name' => 'Blaster Pistol', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 6, 'crit' => 3, 'range_id' => 3, 'encumbrance' => 1, 'hp' => 3, 'value' => 400, 'restricted' => false, 'rarity' => 6, 'special' => 'Stun setting'],
            ['name' => 'Heavy Blaster Pistol', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 7, 'crit' => 3, 'range_id' => 3, 'encumbrance' => 2, 'hp' => 3, 'value' => 700, 'restricted' => false, 'rarity' => 6, 'special' => 'Stun setting'],
            ['name' => 'Blaster Carbine', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 9, 'crit' => 3, 'range_id' => 3, 'encumbrance' => 3, 'hp' => 4, 'value' => 850, 'restricted' => false, 'rarity' => 5, 'special' => 'Stun setting'],
            ['name' => 'Blaster Rifle', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 9, 'crit' => 3, 'range_id' => 4, 'encumbrance' => 4, 'hp' => 4, 'value' => 900, 'restricted' => false, 'rarity' => 5, 'special' => 'Stun setting'],
            ['name' => 'Heavy Blaster Rifle', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 10, 'crit' => 3, 'range_id' => 4, 'encumbrance' => 6, 'hp' => 4, 'value' => 1500, 'restricted' => false, 'rarity' => 6, 'special' => 'Auto-fire. Cumbersome 3'],
            ['name' => 'Light Repeating Blaster', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 11, 'crit' => 3, 'range_id' => 4, 'encumbrance' => 7, 'hp' => 4, 'value' => 2250, 'restricted' => true, 'rarity' => 7, 'special' => 'Auto-fire, Cumbersome 4. Pierce 1'],
            ['name' => 'Heavy Repeating Blaster', 'weapon_type_id' => 1, 'skill_id' => 24, 'damage' => 15, 'crit' => 2, 'range_id' => 4, 'encumbrance' => 9, 'hp' => 4, 'value' => 6000, 'restricted' => true, 'rarity' => 8, 'special' => 'Auto-fire. Cumbersome 5, Pierce 2, Vicious 1'],
            ['name' => 'Bowcaster', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 10, 'crit' => 3, 'range_id' => 3, 'encumbrance' => 5, 'hp' => 2, 'value' => 1250, 'restricted' => false, 'rarity' => 7, 'special' => 'Cumbersome 3, Knockdown'],
            ['name' => 'Ionization Blaster', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 10, 'crit' => 5, 'range_id' => 2, 'encumbrance' => 3, 'hp' => 3, 'value' => 250, 'restricted' => false, 'rarity' => 3, 'special' => 'Disorient 5, Stun Damage (Droid only)'],
            ['name' => 'Disruptor Pistol', 'weapon_type_id' => 1, 'skill_id' => 26, 'damage' => 10, 'crit' => 2, 'range_id' => 2, 'encumbrance' => 2, 'hp' => 2, 'value' => 3000, 'restricted' => true, 'rarity' => 6, 'special' => 'Vicious 4'],
            ['name' => 'Disruptor Rifle', 'weapon_type_id' => 1, 'skill_id' => 27, 'damage' => 10, 'crit' => 2, 'range_id' => 4, 'encumbrance' => 5, 'hp' => 4, 'value' => 5000, 'restricted' => true, 'rarity' => 6, 'special' => 'Cumbersome 2, Vicious 5'],

            ['name' => 'Slugthrower Pistol', 'weapon_type_id' => 2, 'skill_id' => 26, 'damage' => 4, 'crit' => 5, 'range' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 100, 'restricted' => false, 'rarity' => 3, 'special' => ''],
            ['name' => 'Slugthrower Rifle', 'weapon_type_id' => 2, 'skill_id' => 27, 'damage' => 7, 'crit' => 5, 'range' => 3, 'encumbrance' => 5, 'hp' => 1, 'value' => 250, 'restricted' => false, 'rarity' => 3, 'special' => 'Cumbersome 2'],

            ['name' => 'Bola / Net', 'weapon_type_id' => 3, 'skill_id' => 26, 'damage' => 2, 'crit' => 0, 'range' => 2, 'encumbrance' => 1, 'hp' => 2, 'value' => 20, 'restricted' => false, 'rarity' => 2, 'special' => 'Ensnare 3, Knockdown, Limited Ammo 1'],

            ['name' => 'Flame Projector', 'weapon_type_id' => 4, 'skill_id' => 27, 'damage' => 8, 'crit' => 3, 'range' => 2, 'encumbrance' => 6, 'hp' => 2, 'value' => 1000, 'restricted' => false, 'rarity' => 6, 'special' => 'Burn 3, Blast 8'],
            ['name' => 'Missile Tube', 'weapon_type_id' => 4, 'skill_id' => 24, 'damage' => 20, 'crit' => 2, 'range' => 5, 'encumbrance' => 7, 'hp' => 4, 'value' => 7500, 'restricted' => true, 'rarity' => 8, 'special' => 'Blast 10, Cumbersomme 3, Guided 3, Breach 1, Prepare 1, Limited Ammo 6'],
            ['name' => 'Frag Grenade', 'weapon_type_id' => 4, 'skill_id' => 26, 'damage' => 8, 'crit' => 4, 'range' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 50, 'restricted' => false, 'rarity' => 5, 'special' => 'Blast 6, Limited Ammo 1'],
            ['name' => 'Stun Grenade', 'weapon_type_id' => 4, 'skill_id' => 26, 'damage' => 18, 'crit' => 0, 'range' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 75, 'restricted' => false, 'rarity' => 4, 'special' => 'Disorient 3, Stun Damage, Blast 8, Limited Ammo 1'],
            ['name' => 'Thermal Detonator', 'weapon_type_id' => 4, 'skill_id' => 26, 'damage' => 20, 'crit' => 2, 'range' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 2000, 'restricted' => true, 'rarity' => 8, 'special' => 'Blast 15, Breach 1, Vicious 4, Limited Ammo 1'],

            ['name' => 'Brass Knuckles', 'weapon_type_id' => 5, 'skill_id' => 23, 'damage' => 1, 'crit' => 4, 'range' => 1, 'encumbrance' => 1, 'hp' => 0, 'value' => 25, 'restricted' => false, 'rarity' => 0, 'special' => 'Disorient 3'],
            ['name' => 'Shock Gloves', 'weapon_type_id' => 5, 'skill_id' => 23, 'damage' => 0, 'crit' => 5, 'range' => 1, 'encumbrance' => 0, 'hp' => 1, 'value' => 300, 'restricted' => false, 'rarity' => 2, 'special' => 'Stun 3'],

            ['name' => 'Combat Knife', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 1, 'crit' => 3, 'range' => 1, 'encumbrance' => 1, 'hp' => 0, 'value' => 25, 'restricted' => false, 'rarity' => 1, 'special' => ''],
            ['name' => 'Gaffi Stick', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 2, 'crit' => 3, 'range' => 1, 'encumbrance' => 3, 'hp' => 0, 'value' => 100, 'restricted' => false, 'rarity' => 2, 'special' => 'Defensive 1, Disorient 3'],
            ['name' => 'Force Pike', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 3, 'crit' => 2, 'range' => 1, 'encumbrance' => 3, 'hp' => 3, 'value' => 500, 'restricted' => false, 'rarity' => 4, 'special' => 'Pierce 2, Stun Setting'],
            ['name' => 'Lightsaber', 'weapon_type_id' => 6, 'skill_id' => 28, 'damage' => 10, 'crit' => 1, 'range' => 1, 'encumbrance' => 1, 'hp' => 0, 'value' => 10000, 'restricted' => true, 'rarity' => 10, 'special' => 'Breach 1, Sunder, Vicious 2'],
            ['name' => 'Truncheon', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 2, 'crit' => 5, 'range' => 1, 'encumbrance' => 2, 'hp' => 0, 'value' => 15, 'restricted' => false, 'rarity' => 1, 'special' => 'Disorient'],
            ['name' => 'Vibro-Ax', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 3, 'crit' => 2, 'range' => 1, 'encumbrance' => 4, 'hp' => 3, 'value' => 750, 'restricted' => false, 'rarity' => 5, 'special' => 'Pierce 2, Sunder, Vicious 3'],
            ['name' => 'Vibroknife', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 1, 'crit' => 2, 'range' => 1, 'encumbrance' => 1, 'hp' => 2, 'value' => 250, 'restricted' => false, 'rarity' => 3, 'special' => 'Pierce 2, Vicious 1'],
            ['name' => 'Vibrosword', 'weapon_type_id' => 6, 'skill_id' => 25, 'damage' => 2, 'crit' => 2, 'range' => 1, 'encumbrance' => 3, 'hp' => 5, 'value' => 750, 'restricted' => false, 'rarity' => 5, 'special' => 'Pierce 2, Vicious 1, Defensive 1'],
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
