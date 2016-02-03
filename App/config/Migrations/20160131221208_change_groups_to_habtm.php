<?php

use Phinx\Migration\AbstractMigration;
use Cake\Datasource\ConnectionManager;

class ChangeGroupsToHabtm extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('characters_groups');
        $table
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('group_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('group_id', 'groups', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        $conn = ConnectionManager::get('default');
        $conn->query("INSERT INTO characters_groups (character_id, group_id) SELECT id, group_id FROM characters WHERE group_id <> 0");

        $this->table('characters')
            ->dropForeignKey('group_id')
            ->update();

        $this->table('characters')
            ->removeColumn('group_id')
            ->update();

    }
}
