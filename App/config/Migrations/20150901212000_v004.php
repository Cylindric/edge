<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class v004 extends AbstractMigration
{
    public function change()
    {
        $conn = ConnectionManager::get('default');


        $this->table('obligations')
            ->addColumn('note', 'string', ['default' => '', 'limit' => 45, 'null' => false, 'after' => 'value'])
            ->update();

        $this->table('characters_items')
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true, 'after' => 'equipped'])
            ->update();

        $this->table('characters_notes')
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->update();

        // Fix missing timestamps
        $tables = ['characters', 'characters_armour', 'characters_items', 'characters_notes', 'characters_talents', 'characters_weapons', 'groups'];
        foreach($tables as $table) {
            $conn->query('UPDATE '.$table.' SET created = COALESCE(created, NOW()), modified = COALESCE(modified, NOW()) WHERE created is null OR modified is null;');
        }

        $this->table('groups_users')
            ->addColumn('group_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('user_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('gm', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('group_id', 'groups', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        $conn->query(
            'INSERT INTO groups_users (group_id, user_id, gm, created, modified) ' .
            'SELECT c.group_id, u.id, 0, NOW(), NOW() ' .
            'FROM characters c ' .
            'INNER JOIN users u ON (c.user_id = u.id)'
        );

        $this->table('credits')
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('value', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('note', 'text', ['default' => null, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        $conn->query(
            'INSERT INTO credits (character_id, value, note, created, modified) ' .
            "SELECT id, credits, 'Initial funds', NOW(), NOW() " .
            'FROM characters'
        );

        $this->table('characters')
            ->removeColumn('credits')
            ->update();
    }
}
