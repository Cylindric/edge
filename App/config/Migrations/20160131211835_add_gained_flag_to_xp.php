<?php

use Phinx\Migration\AbstractMigration;

class AddGainedFlagToXp extends AbstractMigration
{
    public function change()
    {
        $this->table('xp')
            ->addColumn('isGained', 'boolean', ['default' => false, 'null' => false, 'after' => 'value'])
            ->update();
    }
}
