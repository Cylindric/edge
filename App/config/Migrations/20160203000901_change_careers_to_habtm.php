<?php

use Phinx\Migration\AbstractMigration;
use Cake\Datasource\ConnectionManager;

class ChangeCareersToHabtm extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('characters_careers');
        $table
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('career_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('career_id', 'careers', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        $conn = ConnectionManager::get('default');
        $conn->query("INSERT INTO characters_careers (character_id, career_id, created, modified) SELECT id, career_id, NOW(), NOW() FROM characters WHERE career_id <> 0");

        $this->table('characters')
            ->dropForeignKey('career_id')
            ->update();

        $this->table('characters')
            ->removeColumn('career_id')
            ->update();

    }
}
