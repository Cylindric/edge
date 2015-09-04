<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class v04 extends AbstractMigration
{
    public function change()
    {
        $this->table('obligations')
            ->addColumn('note', 'string', ['default' => '', 'limit' => 45, 'null' => false, 'after' => 'value'])
            ->create();

        $conn = ConnectionManager::get('live');
        $conn->query('UPDATE obligations SET created = NOW() WHERE created is null');
        $conn->query('UPDATE obligations SET modified = NOW() WHERE modified is null');
    }
}
