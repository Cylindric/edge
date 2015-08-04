<?php
use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('characteristics');
        $table
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('code', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->create();
        $table = $this->table('skills');
        $table
            ->addColumn('characteristic_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('skilltype_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addForeignKey(
                'characteristic_id',
                'characteristics',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->create();
        $table = $this->table('characters');
        $table
            ->addColumn('species_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('gender', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('age', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('height', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('weight', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('hair_colour', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('eye_colour', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('build', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('home_planet', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('notable_features', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->create();
        $table = $this->table('growth');
        $table
            ->addColumn('character_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('characteristic_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('level', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
        $table = $this->table('species');
        $table
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 32,
                'null' => false,
            ])
            ->addColumn('class', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('base_wound', 'integer', [
                'default' => 10,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('base_strain', 'integer', [
                'default' => 10,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('base_xp', 'integer', [
                'default' => 100,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('brawn', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('agility', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('intellect', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('cunning', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('willpower', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('presence', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->create();
        $table = $this->table('training');
        $table
            ->addColumn('character_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('skill_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('level', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('training');
        $this->dropTable('species');
        $this->dropTable('growth');
        $this->dropTable('characters');
        $this->dropTable('skills');
        $this->dropTable('characteristics');
    }
}
