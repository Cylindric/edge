<?php if (count($characters) == 0): ?>
	<div class="row">
		<div class="col-md-12">
			<p>You don't have any characters yet. Why not <?= $this->Html->link('create one', ['action' => 'add']) ?>?</p>
		</div>
	</div>
<?php else: ?>

	<div class="row">
		<div class="characters index large-10 medium-9 columns">
			<table cellpadding="0" cellspacing="0">
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
						<td><?= h($character->name) ?></td>
						<td>
							<?= $character->has('species') ? $this->Html->link($character->species->name, ['controller' => 'Species', 'action' => 'view', $character->species->id]) : '' ?>
						</td>
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
	</div>

<?php endif; ?>