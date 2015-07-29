<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Growth'), ['action' => 'edit', $growth->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Growth'), ['action' => 'delete', $growth->id], ['confirm' => __('Are you sure you want to delete # {0}?', $growth->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Growth'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Growth'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characteristics'), ['controller' => 'Characteristics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characteristic'), ['controller' => 'Characteristics', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="growth view large-10 medium-9 columns">
    <h2><?= h($growth->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Character') ?></h6>
            <p><?= $growth->has('character') ? $this->Html->link($growth->character->name, ['controller' => 'Characters', 'action' => 'view', $growth->character->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Characteristic') ?></h6>
            <p><?= $growth->has('characteristic') ? $this->Html->link($growth->characteristic->name, ['controller' => 'Characteristics', 'action' => 'view', $growth->characteristic->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($growth->id) ?></p>
            <h6 class="subheader"><?= __('Level') ?></h6>
            <p><?= $this->Number->format($growth->level) ?></p>
        </div>
    </div>
</div>
