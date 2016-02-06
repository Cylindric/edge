<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class v003 extends AbstractMigration
{
    public function change()
    {
        $conn = ConnectionManager::get('default');

        $this->table('xp')
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('value', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('note', 'string', ['default' => '', 'limit' => 45, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        // Migrate XP data
		$conn->query(
            "INSERT INTO xp (character_id, value, note, created, modified) " .
            "SELECT c.id, c.xp, 'Initial XP', NOW(), NOW() " .
            "FROM characters c " .
			"WHERE c.xp > 0 "
        );

        $this->table('characters')
            ->removeColumn('xp')
            ->update();

    }
}
