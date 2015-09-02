<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class v03 extends AbstractMigration
{
    public function change()
    {
        $table = TableRegistry::get('Species');
        $data = [
            // Far Horizons
            ['name' => 'Arcona', 'class' => 'Arcona', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 1, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 3, 'stat_pr' => 2],
            ['name' => 'Chevin', 'class' => 'Chevin', 'base_wound' => 11, 'base_strain' => 11, 'base_xp' => 80, 'stat_br' => 3, 'stat_ag' => 1, 'stat_int' => 2, 'stat_cun' => 3, 'stat_will' => 2, 'stat_pr' => 1],
            ['name' => 'Gran', 'class' => 'Gran', 'base_wound' => 10, 'base_strain' => 9, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 1, 'stat_will' => 2, 'stat_pr' => 3],

            // Enter the Unknown
            ['name' => 'Chiss', 'class' => 'Chiss', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 3, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 1],
            ['name' => 'Duros', 'class' => 'Duros', 'base_wound' => 11, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 1, 'stat_ag' => 2, 'stat_int' => 3, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Toydarian', 'class' => 'Toydarian', 'base_wound' => 9, 'base_strain' => 12, 'base_xp' => 90, 'stat_br' => 1, 'stat_ag' => 1, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 3, 'stat_pr' => 3],

            // Suns of Fortune
            ['name' => 'Drall', 'class' => 'Drall', 'base_wound' => 8, 'base_strain' => 12, 'base_xp' => 90, 'stat_br' => 1, 'stat_ag' => 1, 'stat_int' => 4, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Selonian', 'class' => 'Selonian', 'base_wound' => 11, 'base_strain' => 10, 'base_xp' => 80, 'stat_br' => 2, 'stat_ag' => 3, 'stat_int' => 2, 'stat_cun' => 1, 'stat_will' => 3, 'stat_pr' => 1],
            ['name' => 'Corellian Human', 'class' => 'Corellian', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 110, 'stat_br' => 2, 'stat_ag' => 2, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],

            // Dangerous Covenants
            ['name' => 'Aqualish', 'class' => 'Aqualish', 'base_wound' => 11, 'base_strain' => 8, 'base_xp' => 90, 'stat_br' => 3, 'stat_ag' => 2, 'stat_int' => 1, 'stat_cun' => 2, 'stat_will' => 2, 'stat_pr' => 2],
            ['name' => 'Klatooinian', 'class' => 'Klatooinian', 'base_wound' => 10, 'base_strain' => 10, 'base_xp' => 100, 'stat_br' => 2, 'stat_ag' => 3, 'stat_int' => 2, 'stat_cun' => 2, 'stat_will' => 1, 'stat_pr' => 2],
            ['name' => 'Weequay', 'class' => 'Weequay', 'base_wound' => 10, 'base_strain' => 9, 'base_xp' => 90, 'stat_br' => 3, 'stat_ag' => 2, 'stat_int' => 1, 'stat_cun' => 3, 'stat_will' => 2, 'stat_pr' => 1],

        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }

        $table = TableRegistry::get('Talents');
        $data = [
            ['name' => 'Mood Reader', 'ranked' => false],
            ['name' => 'Flying', 'ranked' => false],
        ];
        $data = $table->newEntities($data);
        foreach ($data as $entity) {
            $table->save($entity);
        }

        $this->table('xp')
            ->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('value', 'integer', ['default' => 0, 'limit' => 11, 'null' => false])
            ->addColumn('note', 'string', ['default' => '', 'limit' => 45, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();

        // Migrate XP data
        $C = TableRegistry::get('Characters');
        $X = TableRegistry::get('Xp');
        $chars = $C->find('all')->where(['xp >' => 0]);
        foreach ($chars as $char) {
            $xp = $X->newEntity();
            $xp->character_id = $char->id;
            $xp->value = $char->xp;
            $xp->note = 'Initial XP';
            $X->save($xp);
        }

        $this->table('characters')
            ->removeColumn('xp')
            ->update();

    }
}
