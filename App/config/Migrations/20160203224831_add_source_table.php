<?php

use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class AddSourceTable extends AbstractMigration
{
    public function change()
    {
        $this->table('sources')
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addColumn('official', 'boolean', ['default' => false, 'null' => false])
            ->create();

        $table = TableRegistry::get('Sources');
        $data = [
            ['name' => '[unknown]', 'official' => false],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }

        $this->table('armour')
            ->addColumn('source_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'name'])
            ->addForeignKey('source_id', 'sources', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();

        $this->table('careers')
            ->addColumn('source_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'name'])
            ->addForeignKey('source_id', 'sources', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();

        $this->table('items')
            ->addColumn('source_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'name'])
            ->addForeignKey('source_id', 'sources', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();

        $this->table('item_types')
            ->addColumn('source_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'name'])
            ->addForeignKey('source_id', 'sources', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();

        $this->table('skills')
            ->addColumn('source_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'name'])
            ->addForeignKey('source_id', 'sources', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();

        $this->table('specialisations')
            ->addColumn('source_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'name'])
            ->addForeignKey('source_id', 'sources', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();

        $this->table('species')
            ->addColumn('source_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'name'])
            ->addForeignKey('source_id', 'sources', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();

        $this->table('talents')
            ->addColumn('source_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'name'])
            ->addForeignKey('source_id', 'sources', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();

        $this->table('weapons')
            ->addColumn('source_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'name'])
            ->addForeignKey('source_id', 'sources', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->update();
    }
}
