<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Talents extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('talents');
        $table->addColumn('name', 'string', ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('description', 'text', ['default' => '', 'null' => true])
            ->addColumn('ranked', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('activation_type', 'text', ['default' => '', 'limit' => 20])
            ->addColumn('page', 'integer', ['default' => 0, 'limit' => 11])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->create();

        $talents = TableRegistry::get('Talents');
        $data = [
            ['name' => 'Armor Master', 'ranked' => false, 'activation_type' => 'Passive', 'page' => 132],
            ['name' => 'Armor Master (Improved)', 'ranked' => false, 'activation_type' => 'Passive', 'page' => 132],
            ['name' => 'Bacta Specialist', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 132],
            ['name' => 'Bad Motivator', 'ranked' => false, 'activation_type' => 'Active (Action)', 'page' => 132],
            ['name' => 'Balance', 'ranked' => false, 'activation_type' => 'Active (Maneuver)', 'page' => 132],
            ['name' => 'Barrage', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 132],
            ['name' => 'Black Market Contacts', 'ranked' => true, 'activation_type' => 'Active (Incidental)', 'page' => 132],
            ['name' => 'Blooded', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 132],
            ['name' => 'Body Guard', 'ranked' => true, 'activation_type' => 'Active (Maneuver)', 'page' => 132],
            ['name' => 'Brace', 'ranked' => true, 'activation_type' => 'Active (Maneuver)', 'page' => 132],
            ['name' => 'Brilliant Evasion', 'ranked' => false, 'activation_type' => 'Active (Action)', 'page' => 132],
            ['name' => 'Bypass Security', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 133],
            ['name' => 'Codebreaker', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 133],
            ['name' => 'Command', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 133],
            ['name' => 'Confidence', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 133],
            ['name' => 'Contraption', 'ranked' => false, 'activation_type' => 'Active (Action)', 'page' => 133],
            ['name' => 'Convincing Demeanor', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 133],
            ['name' => 'Crippling Blow', 'ranked' => false, 'activation_type' => 'Active', 'page' => 133],
            ['name' => 'Dead to Rights', 'ranked' => false, 'activation_type' => 'Active (Incidental)', 'page' => 134],
            ['name' => 'Dead to Rights (Improved)', 'ranked' => false, 'activation_type' => 'Active (Incidental)', 'page' => 134],
            ['name' => 'Deadly Accuracy', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 134],
            ['name' => 'Dedication', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 134],
            ['name' => 'Defencing Driving', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 134],
            ['name' => 'Defencive Slicing', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 134],
            ['name' => 'Defensive Slicing (Improved)', 'ranked' => false, 'activation_type' => 'Passive', 'page' => 134],
            ['name' => 'Defensive Stance', 'ranked' => true, 'activation_type' => 'Active (Maneuver)', 'page' => 134],
            ['name' => 'Disorient', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 135],
            ['name' => 'Ddge, Active (Incidental', 'ranked' => true, 'activation_type' => 'Out of Turn)', 'page' => 135],
            ['name' => 'Durable', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 135],
            ['name' => 'Enduring', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 135],
            ['name' => 'Expert Tracker', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 135],
            ['name' => 'Familiar Suns', 'ranked' => false, 'activation_type' => 'Active (Maneuver)', 'page' => 135],
            ['name' => 'Feral Strength', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 135],
            ['name' => 'Field Commander', 'ranked' => false, 'activation_type' => 'Active (Action)', 'page' => 135],
            ['name' => 'Field Commander (Improved)', 'ranked' => false, 'activation_type' => 'Passive', 'page' => 135],
            ['name' => 'Fine Tuning', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 135],
            ['name' => 'Forager', 'ranked' => false, 'activation_type' => 'Passive', 'page' => 135],
            ['name' => 'Force Rating', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 135],
            ['name' => 'Frenzied Attack', 'ranked' => true, 'activation_type' => 'Active (Incidental)', 'page' => 135],
            ['name' => 'Full Throttle', 'ranked' => false, 'activation_type' => 'Active (Action)', 'page' => 135],
            ['name' => 'Full Throttle (Improved)', 'ranked' => false, 'activation_type' => 'Active (Maneuver)', 'page' => 136],
            ['name' => 'Full Throttle (Supreme)', 'ranked' => false, 'activation_type' => 'Passive', 'page' => 136],
            ['name' => 'Galaxy Mapper', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 136],
            ['name' => 'Gearhead', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 136],
            ['name' => 'Grit', 'ranked' => true, 'activation_type' => 'Passive', 'page' => 136],
            ['name' => 'Hard Headed', 'ranked' => true, 'activation_type' => 'Active (Action)', 'page' => 136],
            ['name' => 'Hard Headed (Improved)', 'ranked' => false, 'activation_type' => 'Active (Action)', 'page' => 136],
            ['name' => 'Heightened Awareness', 'ranked' => false, 'activation_type' => 'Passive', 'page' => 136]
        ];
        $data = $talents->newEntities($data);
        foreach ($data as $entity) {
            $talents->save($entity);
        }

        $table = $this->table('characters_talents');
        $table->addColumn('character_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('talent_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('rank', 'integer', ['default' => 1, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => true])
            ->addForeignKey('character_id', 'characters', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->addForeignKey('talent_id', 'talents', 'id', ['update' => 'NO_ACTION', 'delete' => 'CASCADE'])
            ->create();


    }
}
