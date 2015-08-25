<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class v0_2 extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('character');
        $table
            ->addColumn('biography', 'text', ['default' => '', 'null' => false])
            ->update();


        $table = $this->table('training');
        $table->rename('characters_skills');

        $table = $this->table('characters_skills');
        $table
            ->addColumn('locked', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('source', 'string', ['default' => '', 'limit' => 20, 'null' => false])
            ->update();

    }
}
