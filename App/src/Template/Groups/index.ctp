<?php $this->Html->addCrumb('Groups'); ?>
<?php if (count($groups) == 0): ?>
    <div class="row">
        <div class="col-md-12">
            <p>You don't have any groups yet. Why not <?= $this->Html->link('create one', ['action' => 'add']) ?>
                ?</p>
        </div>
    </div>
<?php else: ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($groups as $group): ?>
            <tr>
                <td><?= $this->Html->link($group->name, ['action' => 'edit', $group->id]) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-search"></span>', ['action' => 'view', $group->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $group->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $group->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete {0}?', h($group->name))]) ?>
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

<?php endif; ?>