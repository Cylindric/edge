<div class="btn-group" role="group" aria-label="Controls">
        <?= $this->Html->link(__('New Talent'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
</div>

<div class="talents index large-9 medium-8 columns content">
    <h3><?= __('Talents') ?></h3>
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('ranked') ?></th>
                <th><?= $this->Paginator->sort('strain_per_rank') ?></th>
                <th><?= $this->Paginator->sort('soak_per_rank') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($talents as $talent): ?>
            <tr>
                <td><?= h($talent->name) ?></td>
                <td><?= h($talent->ranked) ?></td>
                <td><?= $this->Number->format($talent->strain_per_rank) ?></td>
                <td><?= $this->Number->format($talent->soak_per_rank) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $talent->id], ['class' => 'btn btn-default btn-sm']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $talent->id], ['class' => 'btn btn-default btn-sm']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $talent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talent->id), 'class' => 'btn btn-default btn-sm']) ?>
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
