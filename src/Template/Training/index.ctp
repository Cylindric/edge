<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Training'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="training index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('character_id') ?></th>
            <th><?= $this->Paginator->sort('skill_id') ?></th>
            <th><?= $this->Paginator->sort('level') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($training as $training): ?>
        <tr>
            <td><?= $this->Number->format($training->id) ?></td>
            <td>
                <?= $training->has('character') ? $this->Html->link($training->character->name, ['controller' => 'Characters', 'action' => 'view', $training->character->id]) : '' ?>
            </td>
            <td>
                <?= $training->has('skill') ? $this->Html->link($training->skill->name, ['controller' => 'Skills', 'action' => 'view', $training->skill->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($training->level) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $training->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $training->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $training->id], ['confirm' => __('Are you sure you want to delete # {0}?', $training->id)]) ?>
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
