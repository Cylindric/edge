<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class v007 extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('characters_items');
        $table->addColumn('carried', 'boolean', ['default' => true, 'null' => false])
            ->update();

    }
}
