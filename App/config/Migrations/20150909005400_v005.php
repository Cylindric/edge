<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class v005 extends AbstractMigration
{
    public function change()
    {
        $conn = ConnectionManager::get('default');

        $this->table('sessions', array('id' => false, 'primary_key' => array('id')))
            ->addColumn('id', 'string', ['default' => '', 'limit' => 40, 'null' => false])
            ->addColumn('data', 'text', ['default' => null, 'null' => false])
            ->addColumn('expires', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->create();

        $this->table('xp')
            ->changeColumn('note', 'string', ['limit' => 255])
            ->addColumn('created_by', 'integer', ['default' => 0, 'limit' => 11, 'null' => false, 'after' => 'created'])
            ->addColumn('modified_by', 'integer', ['default' => 0, 'limit' => 11, 'null' => false, 'after' => 'modified'])
            ->update();

        // Default all XP changes to have been done by the GM
        $conn->query(
        'UPDATE xp x ' .
        'INNER JOIN characters c ON (x.character_id = c.id) ' .
        'INNER JOIN groups_users gu ON (c.group_id = gu.group_id AND gu.gm = 1) ' .
        'SET x.created_by = gu.user_id, x.modified_by = gu.user_id'
        );

        $this->table('xp')
            ->addForeignKey('created_by', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('modified_by', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->changeColumn('created_by', 'integer', ['default' => null])
            ->changeColumn('modified_by', 'integer', ['default' => null])
            ->update();

    }
}
