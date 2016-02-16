<?php

use Phinx\Migration\AbstractMigration;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

class AddRankToUsers extends AbstractMigration
{
    public function change()
    {
        $this->table('ranks')
            ->addColumn('threshold', 'integer', ['null' => false])
            ->addColumn('name', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('description', 'string', ['default' => '', 'limit' => 200, 'null' => false])
            ->create();

        $table = TableRegistry::get('Ranks');
        $data = [
            ['name' => 'Guest', 'threshold' => 0, 'description' => 'Unregistered user'],
            ['name' => 'User', 'threshold' => 1, 'description' => 'Newly-registered user'],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }

        $table = $this->table('users');
        $table
            ->addColumn('rank', 'integer', ['default' => 1, 'null' => false, 'after' => 'role'])
            ->update();
    }
}
