<?php
$this->Html->addCrumb('Careers', ['action' => 'index']);
$this->Html->addCrumb($career->name, ['action' => 'view', $career->id]);
?>

<div class="row">
    <div class="col-md-12">

        <?= $this->Form->create($career); ?>

        <?= $this->Form->input('name', ['templateVars' => ['placeholder' => 'New career name']]); ?>
        <?= $this->Form->input('source_id'); ?>
        <?= $this->Form->submit(); ?>
        <?= $this->Form->end() ?>

    </div>
</div>
