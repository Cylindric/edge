<?php
$this->Html->addCrumb('Talents', '/talents');
$this->Html->addCrumb($talent->name);
?>

<div class="btn-group" role="group" aria-label="Controls">
    <?= $this->Html->link(__('Edit Talent'), ['action' => 'edit', $talent->id], ['class' => 'btn btn-default']) ?>
    <?= $this->Form->postLink(__('Delete Talent'), ['action' => 'delete', $talent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talent->id), 'class' => 'btn btn-default']) ?>
    <?= $this->Html->link(__('New Talent'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
</div>

<div class="row">
<div class="col-md-6 col-md-offset-3">
    <h3><?= h($talent->name) ?></h3>
    <table class="table table-condensed">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($talent->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($talent->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Ranked') ?></th>
            <td><?= $talent->ranked ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Strain Per Rank') ?></th>
            <td><?= $this->Number->format($talent->strain_per_rank) ?></td>
        </tr>
        <tr>
            <th><?= __('Soak Per Rank') ?></th>
            <td><?= $this->Number->format($talent->soak_per_rank) ?></td>
        </tr>
        <tr>
            <th><?= __('Source') ?></th>
            <td><?= ($talent->source->name) ?></td>
        </tr>
    </table>
</div>
</div>