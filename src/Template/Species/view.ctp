<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Species'), ['action' => 'edit', $species->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Species'), ['action' => 'delete', $species->id], ['confirm' => __('Are you sure you want to delete # {0}?', $species->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Species'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Species'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="species view large-10 medium-9 columns">
    <h2><?= h($species->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($species->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($species->id) ?></p>
        </div>
    </div>
</div>
