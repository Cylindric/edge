<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Defence extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('characters');
        $table
            ->addColumn('wounds', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('strain', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('defence_ranged', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('defence_melee', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->update();
    }
}
