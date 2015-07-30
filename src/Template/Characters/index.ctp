<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Character'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Species'), ['controller' => 'Species', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Species'), ['controller' => 'Species', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Growth'), ['controller' => 'Growth', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Growth'), ['controller' => 'Growth', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Training'), ['controller' => 'Training', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Training'), ['controller' => 'Training', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="characters index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('species_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($characters as $character): ?>
        <tr>
            <td><?= $this->Number->format($character->id) ?></td>
            <td>
                <?= $character->has('species') ? $this->Html->link($character->species->name, ['controller' => 'Species', 'action' => 'view', $character->species->id]) : '' ?>
            </td>
            <td><?= h($character->name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $character->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $character->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $character->id], ['confirm' => __('Are you sure you want to delete # {0}?', $character->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
