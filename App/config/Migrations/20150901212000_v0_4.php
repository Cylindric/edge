<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class v04 extends AbstractMigration
{
    public function change()
    {
        $this->table('obligations')
            ->addColumn('note', 'string', ['default' => '', 'limit' => 45, 'null' => false, 'after' => 'value'])
            ->update();

        $conn = ConnectionManager::get('default');
        $conn->query('UPDATE obligations SET created = NOW() WHERE created is null');
        $conn->query('UPDATE obligations SET modified = NOW() WHERE modified is null');
        $conn->query('UPDATE users SET created = NOW() WHERE created is null');
        $conn->query('UPDATE users SET modified = NOW() WHERE modified is null');

        $this->table('groups_users')
            ->addColumn('group_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('user_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('gm', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('group_id', 'groups', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        $conn = ConnectionManager::get('default');
        $conn->query(
            'INSERT INTO groups_users (group_id, user_id, gm, created, modified) ' .
            'SELECT c.group_id, u.id, 0, NOW(), NOW() ' .
            'FROM characters c ' .
            'INNER JOIN users u ON (c.user_id = u.id)'
        );

    }
}
