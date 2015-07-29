<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Characteristic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Growth'), ['controller' => 'Growth', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Growth'), ['controller' => 'Growth', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="characteristics index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($characteristics as $characteristic): ?>
        <tr>
            <td><?= $this->Number->format($characteristic->id) ?></td>
            <td><?= h($characteristic->name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $characteristic->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $characteristic->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $characteristic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characteristic->id)]) ?>
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
