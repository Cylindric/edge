<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class v002 extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('characters');
        $table
            ->addColumn('biography', 'text', ['default' => '', 'null' => false, 'after' => 'defence_melee'])
            ->update();


        $table = $this->table('training');
        $table->rename('characters_skills');

        $table = $this->table('characters_skills');
        $table
            ->addColumn('locked', 'boolean', ['default' => false, 'null' => false, 'after' => 'career'])
            ->addColumn('source', 'string', ['default' => '', 'limit' => 20, 'null' => false, 'after' => 'career'])
            ->update();

        $table = $this->table('armour');
        $table
            ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => false])
            ->addColumn('defence', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('soak', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('encumbrance', 'integer', ['default' => 0, 'null' => false])
            ->addColumn('rarity', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('hp', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('value', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('restricted', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();

        $table = TableRegistry::get('Armour');
        $data = [
            ['name' => 'Adverse Environment Gear', 'defence' => 0, 'soak' => 1, 'value' => 500, 'encumbrance' => 2, 'hp' => 1, 'restricted' => false, 'rarity' => 1],
            ['name' => 'Armored Clothing', 'defence' => 1, 'soak' => 1, 'value' => 1000, 'encumbrance' => 3, 'hp' => 1, 'restricted' => false, 'rarity' => 6],
            ['name' => 'Heavy Battle Armor', 'defence' => 1, 'soak' => 2, 'value' => 5000, 'encumbrance' => 6, 'hp' => 4, 'restricted' => true, 'rarity' => 7],
            ['name' => 'Heavy Clothing', 'defence' => 0, 'soak' => 1, 'value' => 50, 'encumbrance' => 1, 'hp' => 0, 'restricted' => false, 'rarity' => 0],
            ['name' => 'Laminate', 'defence' => 0, 'soak' => 2, 'value' => 2500, 'encumbrance' => 4, 'hp' => 3, 'restricted' => false, 'rarity' => 5],
            ['name' => 'Personal Deflector Shield', 'defence' => 0, 'soak' => 0, 'value' => 1000, 'encumbrance' => 2, 'hp' => 0, 'restricted' => false, 'rarity' => 8],
            ['name' => 'Padded Armor', 'defence' => 0, 'soak' => 2, 'value' => 500, 'encumbrance' => 2, 'hp' => 0, 'restricted' => false, 'rarity' => 1],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }

        $table = $this->table('characters_armour');
        $table->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('armour_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('quantity', 'integer', ['default' => 1, 'limit' => 11, 'null' => false])
            ->addColumn('equipped', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('armour_id', 'armour', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();


        $table = $this->table('item_types');
        $table
            ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();

        $table = TableRegistry::get('ItemTypes');
        $data = [
            ['name' => 'Communications'],
            ['name' => 'Poisons'],
            ['name' => 'Detection'],
            ['name' => 'Medical'],
            ['name' => 'Cybernetics'],
            ['name' => 'Entertainment'],
            ['name' => 'Security'],
            ['name' => 'Survival'],
            ['name' => 'Tools'],
            ['name' => 'Black Market'],
            ['name' => 'Personal Equipment'],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }

        $table = $this->table('items');
        $table
            ->addColumn('item_type_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('name', 'string', ['default' => null, 'limit' => 50, 'null' => false])
            ->addColumn('encumbrance', 'integer', ['default' => 0, 'null' => false])
            ->addColumn('rarity', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('value', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('restricted', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('item_type_id', 'item_types', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        $comms = 1;
        $poisons = 2;
        $detection = 3;
        $medical = 4;
        $cyber = 5;
        $ents = 6;
        $security = 7;
        $survival = 8;
        $tools = 9;
        $bm = 10;
        $pe = 11;
        $table = TableRegistry::get('items');
        $data = [
            ['item_type_id' => $comms, 'name' => 'Commlink (handheld)', 'encumbrance' => 0, 'rarity' => 0, 'value' => 25, 'restricted' => false],
            ['item_type_id' => $comms, 'name' => 'Commlink (long range)', 'encumbrance' => 2, 'rarity' => 1, 'value' => 200, 'restricted' => false],
            ['item_type_id' => $comms, 'name' => 'Holo-Messenger', 'encumbrance' => 0, 'rarity' => 4, 'value' => 250, 'restricted' => false],
            ['item_type_id' => $poisons, 'name' => 'Synthetic Standard Neurotoxin', 'encumbrance' => 0, 'rarity' => 6, 'value' => 50, 'restricted' => true],
            ['item_type_id' => $poisons, 'name' => 'Synthetic Standard Anesthetic', 'encumbrance' => 0, 'rarity' => 4, 'value' => 35, 'restricted' => false],
            ['item_type_id' => $poisons, 'name' => 'Synthetic Standard Neuropalaytic', 'encumbrance' => 0, 'rarity' => 6, 'value' => 75, 'restricted' => true],
            ['item_type_id' => $detection, 'name' => 'Electrobinoculars', 'encumbrance' => 0, 'rarity' => 1, 'value' => 250, 'restricted' => false],
            ['item_type_id' => $detection, 'name' => 'General Purpose Scanner', 'encumbrance' => 2, 'rarity' => 3, 'value' => 500, 'restricted' => false],
            ['item_type_id' => $detection, 'name' => 'Hand Scanner', 'encumbrance' => 0, 'rarity' => 2, 'value' => 100, 'restricted' => false],
            ['item_type_id' => $detection, 'name' => 'Macrobinoculars', 'encumbrance' => 1, 'rarity' => 2, 'value' => 75, 'restricted' => false],
            ['item_type_id' => $detection, 'name' => 'Scanner Goggles', 'encumbrance' => 0, 'rarity' => 3, 'value' => 150, 'restricted' => false],
            ['item_type_id' => $detection, 'name' => 'Surveillance Tagger', 'encumbrance' => 0, 'rarity' => 4, 'value' => 175, 'restricted' => true],
            ['item_type_id' => $medical, 'name' => 'Bacta (liter)', 'encumbrance' => 1, 'rarity' => 1, 'value' => 20, 'restricted' => true],
            ['item_type_id' => $medical, 'name' => 'Bacta (full tank)', 'encumbrance' => 12, 'rarity' => 1, 'value' => 4000, 'restricted' => true],
            ['item_type_id' => $medical, 'name' => 'Emergency Medpac', 'encumbrance' => 1, 'rarity' => 1, 'value' => 100, 'restricted' => true],
            ['item_type_id' => $medical, 'name' => 'Medpac', 'encumbrance' => 2, 'rarity' => 2, 'value' => 400, 'restricted' => true],
            ['item_type_id' => $medical, 'name' => 'Stimpack', 'encumbrance' => 0, 'rarity' => 1, 'value' => 25, 'restricted' => true],
            ['item_type_id' => $medical, 'name' => 'Synthskin', 'encumbrance' => 0, 'rarity' => 1, 'value' => 10, 'restricted' => true],
            ['item_type_id' => $cyber, 'name' => 'Cybernetic Arm Mod V', 'encumbrance' => 0, 'rarity' => 6, 'value' => 10000, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Cybernetic Arm Mod VI', 'encumbrance' => 0, 'rarity' => 6, 'value' => 10000, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Cybernetic Brain Implant', 'encumbrance' => 0, 'rarity' => 6, 'value' => 10000, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Cybernetic Eyes', 'encumbrance' => 0, 'rarity' => 6, 'value' => 7500, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Cybernetic Leg Mod II', 'encumbrance' => 0, 'rarity' => 6, 'value' => 10000, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Cybernetic Leg Mod III', 'encumbrance' => 0, 'rarity' => 6, 'value' => 10000, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Cybernetic Weapon', 'encumbrance' => 0, 'rarity' => 7, 'value' => 4000, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'CyberScnner Limb', 'encumbrance' => 0, 'rarity' => 7, 'value' => 4000, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Immune Implant', 'encumbrance' => 0, 'rarity' => 6, 'value' => 5000, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Implant Armor', 'encumbrance' => 0, 'rarity' => 6, 'value' => 7500, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Repli-Limb Prosthetic (limb)', 'encumbrance' => 0, 'rarity' => 5, 'value' => 2000, 'restricted' => false],
            ['item_type_id' => $cyber, 'name' => 'Repli-Limb Prosthetic (organ)', 'encumbrance' => 0, 'rarity' => 5, 'value' => 1000, 'restricted' => false],
            ['item_type_id' => $ents, 'name' => 'Chance Cubes', 'encumbrance' => 0, 'rarity' => 0, 'value' => 1, 'restricted' => false],
            ['item_type_id' => $ents, 'name' => 'Dejarik Table', 'encumbrance' => 10, 'rarity' => 1, 'value' => 350, 'restricted' => false],
            ['item_type_id' => $ents, 'name' => 'Sabacc Deck', 'encumbrance' => 0, 'rarity' => 0, 'value' => 40, 'restricted' => false],
            ['item_type_id' => $security, 'name' => 'Binders', 'encumbrance' => 0, 'rarity' => 0, 'value' => 25, 'restricted' => false],
            ['item_type_id' => $security, 'name' => 'Comm Jammer', 'encumbrance' => 4, 'rarity' => 3, 'value' => 400, 'restricted' => false],
            ['item_type_id' => $security, 'name' => 'Comm Scrambler', 'encumbrance' => 0, 'rarity' => 5, 'value' => 1000, 'restricted' => false],
            ['item_type_id' => $security, 'name' => 'Disguise Kit', 'encumbrance' => 2, 'rarity' => 4, 'value' => 100, 'restricted' => false],
            ['item_type_id' => $security, 'name' => 'Electronic Lock Breaker', 'encumbrance' => 1, 'rarity' => 5, 'value' => 1000, 'restricted' => true],
            ['item_type_id' => $security, 'name' => 'Restraining Bolt', 'encumbrance' => 0, 'rarity' => 0, 'value' => 35, 'restricted' => false],
            ['item_type_id' => $security, 'name' => 'Slicer Gear', 'encumbrance' => 2, 'rarity' => 4, 'value' => 500, 'restricted' => false],
            ['item_type_id' => $survival, 'name' => 'Crash Survival Kit', 'encumbrance' => 5, 'rarity' => 2, 'value' => 300, 'restricted' => false],
            ['item_type_id' => $survival, 'name' => 'Ration Pack', 'encumbrance' => 0, 'rarity' => 0, 'value' => 5, 'restricted' => false],
            ['item_type_id' => $survival, 'name' => 'Breath Mask', 'encumbrance' => 1, 'rarity' => 1, 'value' => 25, 'restricted' => false],
            ['item_type_id' => $survival, 'name' => 'Space Suit', 'encumbrance' => 4, 'rarity' => 1, 'value' => 100, 'restricted' => false],
            ['item_type_id' => $survival, 'name' => 'Tent', 'encumbrance' => 4, 'rarity' => 1, 'value' => 100, 'restricted' => false],
            ['item_type_id' => $survival, 'name' => 'Thermal Cloak', 'encumbrance' => 2, 'rarity' => 1, 'value' => 200, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Backpack', 'encumbrance' => 0, 'rarity' => 0, 'value' => 50, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Climbing Gear', 'encumbrance' => 1, 'rarity' => 2, 'value' => 50, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Datapad', 'encumbrance' => 1, 'rarity' => 1, 'value' => 75, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Emergency Repair Patch', 'encumbrance' => 0, 'rarity' => 1, 'value' => 25, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Extra Reloads', 'encumbrance' => 1, 'rarity' => 1, 'value' => 25, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Fusion Lantern', 'encumbrance' => 2, 'rarity' => 2, 'value' => 150, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Glow Rod', 'encumbrance' => 1, 'rarity' => 0, 'value' => 10, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Jet Pack', 'encumbrance' => 2, 'rarity' => 7, 'value' => 4500, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Tool Kit', 'encumbrance' => 4, 'rarity' => 2, 'value' => 350, 'restricted' => false],
            ['item_type_id' => $tools, 'name' => 'Utility Belt', 'encumbrance' => 0, 'rarity' => 0, 'value' => 25, 'restricted' => false],
            ['item_type_id' => $bm, 'name' => 'Avabush Spice (dose)', 'encumbrance' => 0, 'rarity' => 6, 'value' => 25, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Avabush Spice (100 dose container)', 'encumbrance' => 3, 'rarity' => 7, 'value' => 2000, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Booster Blue (dose)', 'encumbrance' => 0, 'rarity' => 5, 'value' => 10, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Booster Blue (100 dose container)', 'encumbrance' => 3, 'rarity' => 6, 'value' => 750, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Death Sticks (dose)', 'encumbrance' => 0, 'rarity' => 1, 'value' => 5, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Death Sticks (100 dose container)', 'encumbrance' => 3, 'rarity' => 2, 'value' => 250, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Glitterstim (dose)', 'encumbrance' => 0, 'rarity' => 7, 'value' => 100, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Glitterstim (100 dose container)', 'encumbrance' => 5, 'rarity' => 8, 'value' => 5000, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Lesai (dose)', 'encumbrance' => 0, 'rarity' => 9, 'value' => 500, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Lesai (100 dose container)', 'encumbrance' => 2, 'rarity' => 10, 'value' => 7500, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Yarrock (dose)', 'encumbrance' => 0, 'rarity' => 8, 'value' => 350, 'restricted' => true],
            ['item_type_id' => $bm, 'name' => 'Yarrock (100 dose container)', 'encumbrance' => 3, 'rarity' => 9, 'value' => 20000, 'restricted' => true],
            ['item_type_id' => $pe, 'name' => 'Data Breaker', 'encumbrance' => 1, 'rarity' => 6, 'value' => 1000, 'restricted' => true],
            ['item_type_id' => $pe, 'name' => 'Flesh Camouflage Set', 'encumbrance' => 2, 'rarity' => 7, 'value' => 2500, 'restricted' => true],
            ['item_type_id' => $pe, 'name' => 'Personal Stealth Field', 'encumbrance' => 1, 'rarity' => 9, 'value' => 20000, 'restricted' => true],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }

        $table = $this->table('characters_items');
        $table->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('item_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('quantity', 'integer', ['default' => 1, 'limit' => 11, 'null' => false])
            ->addColumn('equipped', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('item_id', 'items', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

    }
}
