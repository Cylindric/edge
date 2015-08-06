<div class="row">
	<div class="users index large-10 medium-9 columns">
		<table cellpadding="0" cellspacing="0">
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
					<td>
						<?= $user->role ?>
					</td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
