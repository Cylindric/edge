<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Groups extends AbstractMigration
{
    public function change()
    {
        $this->table('characters')
            ->addColumn('group_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->update();

        $this->table('characters_groups')
            ->drop();

    }
}
