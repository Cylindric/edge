<?php

use Phinx\Migration\AbstractMigration;

class AddTableChronicles extends AbstractMigration {

    public function change() {
        $this->table('chronicles')
                ->addColumn('group_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
                ->addColumn('user_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
                ->addColumn('title', 'string', ['default' => null, 'limit' => 45, 'null' => false])
                ->addColumn('story', 'text', ['default' => null, 'null' => false])
                ->addColumn('published', 'boolean', ['default' => false, 'null' => false])
                ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
                ->addColumn('created_by', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
                ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
                ->addColumn('modified_by', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
                ->addForeignKey('user_id', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
                ->addForeignKey('group_id', 'groups', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
                ->addForeignKey('created_by', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
                ->addForeignKey('modified_by', 'users', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
                ->create();
    }

}
