<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $growth->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $growth->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Growth'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characteristics'), ['controller' => 'Characteristics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characteristic'), ['controller' => 'Characteristics', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="growth form large-10 medium-9 columns">
    <?= $this->Form->create($growth) ?>
    <fieldset>
        <legend><?= __('Edit Growth') ?></legend>
        <?php
            echo $this->Form->input('character_id', ['options' => $characters]);
            echo $this->Form->input('characteristic_id', ['options' => $characteristics]);
            echo $this->Form->input('level');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
