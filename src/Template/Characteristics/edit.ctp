<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $characteristic->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $characteristic->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Characteristics'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Growth'), ['controller' => 'Growth', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Growth'), ['controller' => 'Growth', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="characteristics form large-10 medium-9 columns">
    <?= $this->Form->create($characteristic) ?>
    <fieldset>
        <legend><?= __('Edit Characteristic') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
