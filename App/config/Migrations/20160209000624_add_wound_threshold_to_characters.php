<?php

use Phinx\Migration\AbstractMigration;
use Cake\Datasource\ConnectionManager;

class AddWoundThresholdToCharacters extends AbstractMigration
{
    public function change()
    {
        $this->table('characters')
            ->addColumn('wound_threshold', 'integer', ['default' => 0, 'null' => false, 'after' => 'wounds'])
            ->addColumn('strain_threshold', 'integer', ['default' => 0, 'null' => false, 'after' => 'strain'])
            ->update();

        $conn = ConnectionManager::get('default');
        $conn->query("UPDATE characters c " .
                     "INNER JOIN species s ON (c.species_id = s.id) " .
                     "SET c.wound_threshold = c.wound_threshold - s.base_wound - c.stat_br," .
                     "c.strain_threshold = c.strain_threshold - s.base_strain - c.stat_will;");

   }
}
