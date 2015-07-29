<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Growth'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characteristics'), ['controller' => 'Characteristics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Characteristic'), ['controller' => 'Characteristics', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="growth index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('character_id') ?></th>
            <th><?= $this->Paginator->sort('characteristic_id') ?></th>
            <th><?= $this->Paginator->sort('level') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($growth as $growth): ?>
        <tr>
            <td><?= $this->Number->format($growth->id) ?></td>
            <td>
                <?= $growth->has('character') ? $this->Html->link($growth->character->name, ['controller' => 'Characters', 'action' => 'view', $growth->character->id]) : '' ?>
            </td>
            <td>
                <?= $growth->has('characteristic') ? $this->Html->link($growth->characteristic->name, ['controller' => 'Characteristics', 'action' => 'view', $growth->characteristic->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($growth->level) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $growth->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $growth->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $growth->id], ['confirm' => __('Are you sure you want to delete # {0}?', $growth->id)]) ?>
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
