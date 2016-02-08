<?php
use Phinx\Migration\AbstractMigration;

class v006 extends AbstractMigration
{
    public function change()
    {
        $this->table('species')
            ->removeColumn('class')
            ->update();

        $this->table('talents')
            ->addColumn('description', 'string', ['default' => null, 'limit' => 255, 'null' => true])
            ->update();
    }
}
