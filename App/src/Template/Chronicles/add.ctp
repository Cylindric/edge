<?php
$this->Html->addCrumb('Chronicles', ['action' => 'index']);
?>

<div class="row">
    <div class="col-md-12">

        <?= $this->Form->create($chronicle); ?>
        <?= $this->Form->hidden('group_id'); ?>
        <?= $this->Form->input('title', ['templateVars' => ['placeholder' => 'Title']]); ?>
        <?= $this->Form->textarea('story', ['templateVars' => ['placeholder' => 'New species name']]); ?>
        <?= $this->Form->submit(); ?>
        <?= $this->Form->end() ?>

    </div>
</div>
