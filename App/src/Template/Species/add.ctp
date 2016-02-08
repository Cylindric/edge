<?php
$this->Html->addCrumb('Species', ['action' => 'index']);
$this->Html->addCrumb($species->name, ['action' => 'view', $species->id]);
?>

<div class="row">
    <div class="col-md-12">

        <?= $this->Form->create($species); ?>
        <?= $this->Form->input('name', ['templateVars' => ['placeholder' => 'New species name']]); ?>
        <?= $this->Form->input('base_wound', ['templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('base_strain', ['templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('base_xp', ['label' => 'XP', 'templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('stat_br', ['label' => 'Brawn', 'templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('stat_ag', ['label' => 'Agility', 'templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('stat_int', ['label' => 'Intellect', 'templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('stat_will', ['label' => 'Willpower', 'templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('stat_cun', ['label' => 'Cunning', 'templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('stat_pr', ['label' => 'Presence', 'templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('source_id'); ?>
        <?= $this->Form->submit(); ?>
        <?= $this->Form->end() ?>

    </div>
</div>
