<?php
$this->Html->addCrumb('Species', '/species');
$this->Html->addCrumb($species->name, ['action' => 'view', $species->id]);
?>
<div class="btn-group" role="group" aria-label="Controls">
    <?=
    $this->Form->postLink(
            __('Delete'), ['action' => 'delete', $species->id], ['confirm' => __('Are you sure you want to delete # {0}?', $species->id), 'class' => 'btn btn-default']
    )
    ?>
</div>

<div class="row">
    <div class="col-md-12">

        <?= $this->Form->create($species); ?>
        <?= $this->Form->input('name'); ?>
        <?= $this->Form->input('base_wound'); ?>
        <?= $this->Form->input('base_strain'); ?>
        <?= $this->Form->input('base_xp', ['label' => 'XP']); ?>
        <?= $this->Form->input('stat_br', ['label' => 'Brawn']); ?>
        <?= $this->Form->input('stat_ag', ['label' => 'Agility']); ?>
        <?= $this->Form->input('stat_int', ['label' => 'Intellect']); ?>
        <?= $this->Form->input('stat_will', ['label' => 'Willpower']); ?>
        <?= $this->Form->input('stat_cun', ['label' => 'Cunning']); ?>
        <?= $this->Form->input('stat_pr', ['label' => 'Presence']); ?>
        <?= $this->Form->input('source_id'); ?>
        <?= $this->Form->submit(); ?>
        <?= $this->Form->end() ?>

    </div>
</div>
