<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $skill->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $skill->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Skills'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characteristics'), ['controller' => 'Characteristics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characteristic'), ['controller' => 'Characteristics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Training'), ['controller' => 'Training', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Training'), ['controller' => 'Training', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="skills form large-10 medium-9 columns">
    <?= $this->Form->create($skill) ?>
    <fieldset>
        <legend><?= __('Edit Skill') ?></legend>
        <?php
            echo $this->Form->input('characteristic_id', ['options' => $characteristics]);
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
