<?php $this->assign('title', $character->name);?>
<div class="row">
    <div class="col-md-4">
        <h3><?= __('Actions') ?></h3>
        <ul class="side-nav">
            <li><?= $this->Html->link(__('Edit Character'), ['action' => 'edit', $character->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Character'), ['action' => 'delete', $character->id], ['confirm' => __('Are you sure you want to delete # {0}?', $character->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Characters'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Character'), ['action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Growth'), ['controller' => 'Growth', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Growth'), ['controller' => 'Growth', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Training'), ['controller' => 'Training', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Training'), ['controller' => 'Training', 'action' => 'add']) ?> </li>
        </ul>
    </div>
    <div class="col-md-6">

        <div class="row">
            <h2><?= h($character->name) ?></h2>
        </div>

        <div class="row">
            <?php if (!empty($stats)): ?>
                <?php foreach ($stats as $stat): ?>
                    <div class="col-md-2 text-center">
                        <?= h($stat->name) ?><br/><?= h($stat->total) ?>
                    </div>

                <?php endforeach; ?>

            <?php endif; ?>
        </div>
    </div>

</div>