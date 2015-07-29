<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Characters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Growth'), ['controller' => 'Growth', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Growth'), ['controller' => 'Growth', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Training'), ['controller' => 'Training', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Training'), ['controller' => 'Training', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="characters form large-10 medium-9 columns">
    <?= $this->Form->create($character) ?>
    <fieldset>
        <legend><?= __('Add Character') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
