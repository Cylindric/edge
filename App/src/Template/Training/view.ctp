<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Training'), ['action' => 'edit', $training->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Training'), ['action' => 'delete', $training->id], ['confirm' => __('Are you sure you want to delete # {0}?', $training->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Training'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Training'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="training view large-10 medium-9 columns">
    <h2><?= h($training->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Character') ?></h6>
            <p><?= $training->has('character') ? $this->Html->link($training->character->name, ['controller' => 'Characters', 'action' => 'view', $training->character->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Skill') ?></h6>
            <p><?= $training->has('skill') ? $this->Html->link($training->skill->name, ['controller' => 'Skills', 'action' => 'view', $training->skill->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($training->id) ?></p>
            <h6 class="subheader"><?= __('Level') ?></h6>
            <p><?= $this->Number->format($training->level) ?></p>
        </div>
    </div>
</div>
