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
