<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $training->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $training->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Training'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="training form large-10 medium-9 columns">
    <?= $this->Form->create($training) ?>
    <fieldset>
        <legend><?= __('Edit Training') ?></legend>
        <?php
            echo $this->Form->input('character_id', ['options' => $characters]);
            echo $this->Form->input('skill_id', ['options' => $skills]);
            echo $this->Form->input('level');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
