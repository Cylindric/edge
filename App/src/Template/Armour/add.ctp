<?php
$this->Html->addCrumb('Armour', '/armour');
$this->Html->addCrumb($armour->name, ['action' => 'view', $armour->id]);
?>

<div class="row">
    <div class="col-md-12">

        <?= $this->Form->create($armour); ?>

        <?= $this->Form->input('name', ['templateVars' => ['placeholder' => 'New armour name']]); ?>
        <?= $this->Form->input('defence', ['templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('soak', ['templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('encumbrance', ['templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('rarity', ['templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('hp', ['templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('value', ['templateVars' => ['placeholder' => '0']]); ?>
        <?= $this->Form->input('source_id'); ?>
        <?= $this->Form->submit(); ?>
        <?= $this->Form->end() ?>

    </div>
</div>
