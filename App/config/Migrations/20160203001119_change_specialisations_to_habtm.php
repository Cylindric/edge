<?php

use Phinx\Migration\AbstractMigration;
use Cake\Datasource\ConnectionManager;

class ChangeSpecialisationsToHabtm extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('characters_specialisations');
        $table
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('specialisation_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('specialisation_id', 'specialisations', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        $conn = ConnectionManager::get('default');
        $conn->query("INSERT INTO characters_specialisations (character_id, specialisation_id, created, modified) SELECT id, specialisation_id, NOW(), NOW() FROM characters WHERE specialisation_id <> 0");

        $this->table('characters')
            ->dropForeignKey('specialisation_id')
            ->update();

        $this->table('characters')
            ->removeColumn('specialisation_id')
            ->update();

    }
}
