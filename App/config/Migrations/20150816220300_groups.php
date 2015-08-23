<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Groups extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('weapons');
        $table
            ->addForeignKey('range_id', 'ranges', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('skill_id', 'skills', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();
        $this->createTableCareers();
        $this->createTableSpecialisations();
        $this->createTableObligations();
        $this->createTableWeaponTypes();
        $this->createTableRanges();
        $this->createTableWeapons();
        $this->createTableCharactersWeapons();

        $this->table('characters')
            ->addColumn('group_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false, 'after' => 'species_id'])
            ->addColumn('credits', 'integer', ['default' => 0, 'limit' => 11, 'null' => false, 'after' => 'notable_features'])
            ->addColumn('xp', 'integer', ['default' => 0, 'limit' => 11, 'null' => false, 'after' => 'specialisation_id'])
            ->addColumn('soak', 'integer', ['default' => 0, 'limit' => 11, 'null' => false, 'after' => 'specialisation_id'])
            ->update();

        $this->table('characters_groups')
            ->drop();

        $this->table('training')
            ->addColumn('career', 'boolean', ['default' => false, 'null' => false, 'after' => 'level'])
            ->update();
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

        $this->table('characters')
            ->addColumn('career_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->update();
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

        $this->table('characters')
            ->addColumn('specialisation_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->update();
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

            ['name' => 'Slugthrower Pistol', 'weapontype_id' => 2, 'skill_id' => 26, 'damage' => 4, 'crit' => 5, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 100, 'restricted' => false, 'rarity' => 3, 'special' => ''],
            ['name' => 'Slugthrower Rifle', 'weapontype_id' => 2, 'skill_id' => 27, 'damage' => 7, 'crit' => 5, 'range_id' => 3, 'encumbrance' => 5, 'hp' => 1, 'value' => 250, 'restricted' => false, 'rarity' => 3, 'special' => 'Cumbersome 2'],

            ['name' => 'Bola / Net', 'weapontype_id' => 3, 'skill_id' => 26, 'damage' => 2, 'crit' => 0, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 2, 'value' => 20, 'restricted' => false, 'rarity' => 2, 'special' => 'Ensnare 3, Knockdown, Limited Ammo 1'],

            ['name' => 'Flame Projector', 'weapontype_id' => 4, 'skill_id' => 27, 'damage' => 8, 'crit' => 3, 'range_id' => 2, 'encumbrance' => 6, 'hp' => 2, 'value' => 1000, 'restricted' => false, 'rarity' => 6, 'special' => 'Burn 3, Blast 8'],
            ['name' => 'Missile Tube', 'weapontype_id' => 4, 'skill_id' => 24, 'damage' => 20, 'crit' => 2, 'range_id' => 5, 'encumbrance' => 7, 'hp' => 4, 'value' => 7500, 'restricted' => true, 'rarity' => 8, 'special' => 'Blast 10, Cumbersomme 3, Guided 3, Breach 1, Prepare 1, Limited Ammo 6'],
            ['name' => 'Frag Grenade', 'weapontype_id' => 4, 'skill_id' => 26, 'damage' => 8, 'crit' => 4, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 50, 'restricted' => false, 'rarity' => 5, 'special' => 'Blast 6, Limited Ammo 1'],
            ['name' => 'Stun Grenade', 'weapontype_id' => 4, 'skill_id' => 26, 'damage' => 18, 'crit' => 0, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 75, 'restricted' => false, 'rarity' => 4, 'special' => 'Disorient 3, Stun Damage, Blast 8, Limited Ammo 1'],
            ['name' => 'Thermal Detonator', 'weapontype_id' => 4, 'skill_id' => 26, 'damage' => 20, 'crit' => 2, 'range_id' => 2, 'encumbrance' => 1, 'hp' => 0, 'value' => 2000, 'restricted' => true, 'rarity' => 8, 'special' => 'Blast 15, Breach 1, Vicious 4, Limited Ammo 1'],

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
}
