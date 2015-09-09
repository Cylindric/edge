<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class v005 extends AbstractMigration
{
    public function change()
    {
        $this->table('sessions', array('id' => false, 'primary_key' => array('id')))
            ->addColumn('id', 'string', ['default' => '', 'limit' => 40, 'null' => false])
            ->addColumn('data', 'text', ['default' => null, 'null' => false])
            ->addColumn('expires', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->create();
    }
}
