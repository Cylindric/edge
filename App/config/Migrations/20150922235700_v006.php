<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class v006 extends AbstractMigration
{
    public function change()
    {
        $this->table('species')
            ->removeColumn('class')
            ->update();
    }
}
