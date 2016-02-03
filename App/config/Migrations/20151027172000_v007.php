<?php
use Phinx\Migration\AbstractMigration;
use Cake\Datasource\ConnectionManager;

class v007 extends AbstractMigration
{
    public function change()
    {
        $conn = ConnectionManager::get('default');

        $table = $this->table('characters_items');
        $table->addColumn('carried', 'boolean', ['default' => true, 'null' => false])
            ->update();

        // Fix error
        $conn->query("UPDATE weapons SET skill_id = 26 WHERE name = 'Heavy Blaster Pistol' AND skill_id=27");

        $conn->query("INSERT INTO characters_skills (character_id, skill_id, level, career, locked, source, created, modified) "
            . "SELECT character_id, skill_id, 0, 1, 1, '', created, modified "
            . "FROM characters_skills "
            . "WHERE career=1 AND level>0");

        $conn->query("UPDATE characters_skills SET career=0 WHERE career=1 AND level>0");

        $table = $this->table('talents');
        $table->addColumn('soak_per_rank', 'integer', ['default' => 0, 'limit' => 11, 'null' => false, 'after' => 'ranked'])
            ->addColumn('strain_per_rank', 'integer', ['default' => 0, 'limit' => 11, 'null' => false, 'after' => 'ranked'])
            ->update();

        $conn->query("UPDATE talents SET soak_per_rank = 1 WHERE name = 'Enduring'");
        $conn->query("UPDATE talents SET strain_per_rank = 1 WHERE name = 'Grit'");

    }
}
