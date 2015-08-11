<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Notes extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('notes');
        $table->addColumn('note', 'text', ['default' => null, 'null' => false])
            ->addColumn('private', 'boolean', ['default' => true, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();

        $table = $this->table('characters_notes');
        $table->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('note_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('note_id', 'notes', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

    }
}
