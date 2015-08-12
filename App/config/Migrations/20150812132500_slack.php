<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Slack extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('slack');
        $table->addColumn('entity', 'text', ['default' => null, 'limit' => 20, 'null' => false])
            ->addColumn('entity_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('messages', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();

        $talents = TableRegistry::get('Talents');
        $data = [
			['name' => 'Regeneration', 'ranked' => false],
			['name' => 'Claws', 'ranked' => false],
        ];
        $data = $talents->newEntities($data);
        foreach ($data as $entity) {
            $talents->save($entity);
        }

	}
}
