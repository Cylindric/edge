<?php if (count($characters) == 0): ?>
    <div class="row">
        <div class="col-md-12">
            <p>You don't have any characters yet. Why not <?= $this->Html->link('create one', ['action' => 'add']) ?>
                ?</p>
        </div>
    </div>
<?php else: ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('species_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($characters as $character): ?>
            <tr>
                <td><?= $this->Html->link($character->name, ['action' => 'edit', $character->id]) ?></td>
                <td><?= h($character->species->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-search"></span>', ['action' => 'view', $character->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $character->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $character->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete {0}?', h($character->name))]) ?>
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