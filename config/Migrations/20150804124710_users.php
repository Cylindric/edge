<?php
use Phinx\Migration\AbstractMigration;

class Users extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('stats');
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
            ->addColumn('stat_id', 'integer', [
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
                'stat_id',
                'stats',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->create();
        $table = $this->table('characters');
        $table
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
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
            ->addColumn('stat_br', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_ag', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_int', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_cun', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_will', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_pr', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
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
            ->addColumn('stat_br', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_ag', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_int', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_cun', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_will', 'integer', [
                'default' => 2,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('stat_pr', 'integer', [
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
        $table = $this->table('users');
        $table
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('role', 'string', [
                'default' => null,
                'limit' => 20,
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
    }

    public function down()
    {
        $this->dropTable('users');
        $this->dropTable('training');
        $this->dropTable('species');
        $this->dropTable('characters');
        $this->dropTable('skills');
        $this->dropTable('stats');
    }
}
