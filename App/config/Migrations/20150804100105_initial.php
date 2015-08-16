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
        $this->createTableTraining();

        // these tables depend on the above tables in some way
        $this->createTableCharacters();
        $this->createTableUsers();
        $this->createTableCharactersTalents();
        $this->createTableCharactersNotes();
    }

    function createTableCharacters()
    {
        $table = $this->table('characters');
        $table
            ->addColumn('user_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('species_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('group_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
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
        $table->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('talent_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('rank', 'integer', ['default' => 1, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('talent_id', 'talents', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
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

    function createTableTraining()
    {
        $table = $this->table('training');
        $table
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('skill_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('level', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('skill_id', 'skills', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();
    }
}
