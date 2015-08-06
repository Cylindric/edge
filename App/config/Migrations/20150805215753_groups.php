<?php

use Phinx\Migration\AbstractMigration;

class Groups extends AbstractMigration
{
	public function change()
	{
		$this->table('groups')
			->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
			->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->create();

		$this->table('stats')
			->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->update();

		$this->table('skills')
			->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->update();

		$this->table('species')
			->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->update();

		$this->table('characters')
			->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
			->update();

	}
}
