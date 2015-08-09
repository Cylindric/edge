<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('name') ?></th>
        <th><?= $this->Paginator->sort('role') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= h($user->username) ?></td>
            <td><?= $user->role ?></td>
            <td>
                <?= $this->Html->link('<span class="glyphicon glyphicon-search"></span>', ['action' => 'view', $user->id], ['escape' => false]) ?>
                <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $user->id], ['escape' => false]) ?>
                <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $user->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete {0}?', h($user->username))]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>


