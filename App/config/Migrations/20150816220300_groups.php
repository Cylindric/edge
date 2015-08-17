<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Groups extends AbstractMigration
{
    public function change()
    {
        $this->createTableCareers();
        $this->createTableSpecialisations();

        $this->table('characters')
            ->addColumn('group_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->update();

        $this->table('characters_groups')
            ->drop();

        $this->table('training')
            ->addColumn('career', 'boolean', ['default' => false, 'null' => false])
            ->update();
    }

    function createTableCareers()
    {
        $this->table('careers')
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->create();

        $table = TableRegistry::get('Careers');
        $data = [
            ['id' => 1, 'name' => 'Bounty Hunter'],
            ['id' => 2, 'name' => 'Colonist'],
            ['id' => 3, 'name' => 'Explorer'],
            ['id' => 4, 'name' => 'Hired Gun'],
            ['id' => 5, 'name' => 'Smuggler'],
            ['id' => 6, 'name' => 'Technician'],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }

        $this->table('characters')
            ->addColumn('career_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->update();
    }

    function createTableSpecialisations()
    {
        $this->table('specialisations')
            ->addColumn('name', 'string', ['default' => null, 'limit' => 45, 'null' => false])
            ->addColumn('career_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->create();

        $table = TableRegistry::get('Specialisations');
        $data = [
            ['name' => 'Assassin', 'career_id' => 1],
            ['name' => 'Gadgeteer', 'career_id' => 1],
            ['name' => 'Survivalist', 'career_id' => 1],
            ['name' => 'Doctor', 'career_id' => 2],
            ['name' => 'Politico', 'career_id' => 2],
            ['name' => 'Scholar', 'career_id' => 2],
            ['name' => 'Fringer', 'career_id' => 3],
            ['name' => 'Scout', 'career_id' => 3],
            ['name' => 'Trader', 'career_id' => 3],
            ['name' => 'Bodyguard', 'career_id' => 4],
            ['name' => 'Marauder', 'career_id' => 4],
            ['name' => 'Mercenary Soldier', 'career_id' => 4],
            ['name' => 'Pilot', 'career_id' => 5],
            ['name' => 'Scoundrel', 'career_id' => 5],
            ['name' => 'Thief', 'career_id' => 5],
            ['name' => 'Mechanic', 'career_id' => 6],
            ['name' => 'Outlaw Tech', 'career_id' => 6],
            ['name' => 'Slicer', 'career_id' => 6],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }

        $this->table('characters')
            ->addColumn('specialisation_id', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->update();
    }
}
