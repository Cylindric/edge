<?php
$this->Html->addCrumb('Species', '/species');
$this->Html->addCrumb($species->name);
?>

<div class="btn-group" role="group" aria-label="Controls">
    <?= $this->Html->link(__('Edit Species'), ['action' => 'edit', $species->id], ['class' => 'btn btn-default']) ?>
    <?= $this->Form->postLink(__('Delete Species'), ['action' => 'delete', $species->id], ['confirm' => __('Are you sure you want to delete # {0}?', $species->id), 'class' => 'btn btn-default']) ?>
    <?= $this->Html->link(__('New Species'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h3><?= h($species->name) ?></h3>
        <table class="table table-condensed">
            <tr>
                <th><?= __('Name') ?></th>
                <td><?= h($species->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Base Wounds') ?></th>
                <td><?= h($species->base_wound) ?></td>
            </tr>
            <tr>
                <th><?= __('Base Strain') ?></th>
                <td><?= h($species->base_strain) ?></td>
            </tr>
            <tr>
                <th><?= __('Base XP') ?></th>
                <td><?= h($species->base_xp) ?></td>
            </tr>
            <tr>
                <th><?= __('Brawn') ?></th>
                <td><?= h($species->stat_br) ?></td>
            </tr>
            <tr>
                <th><?= __('Agility') ?></th>
                <td><?= h($species->stat_ag) ?></td>
            </tr>
            <tr>
                <th><?= __('Intellect') ?></th>
                <td><?= h($species->stat_int) ?></td>
            </tr>
            <tr>
                <th><?= __('Cunning') ?></th>
                <td><?= h($species->stat_cun) ?></td>
            </tr>
            <tr>
                <th><?= __('Willpower') ?></th>
                <td><?= h($species->stat_will) ?></td>
            </tr>
            <tr>
                <th><?= __('Presence') ?></th>
                <td><?= h($species->stat_pr) ?></td>
            </tr>
            <tr>
                <th><?= __('Source') ?></th>
                <td><?= ($species->source->name) ?></td>
            </tr>
        </table>
    </div>
</div>