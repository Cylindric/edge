<div class="btn-group" role="chronicle" aria-label="Controls">
	<?= $this->Html->link(__('New Chronicle'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
</div>

<h3><?= __('Chronicles') ?></h3>

<div class="row">
	<div class="col-md-12">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?= $this->Paginator->sort('title') ?></th>
				<th><?= $this->Paginator->sort('story') ?></th>
				<th class="actions"><?= __('Actions') ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($chronicles as $chronicle): ?>
				<tr>
					<td><?= h($chronicle->title) ?></td>
					<td><?= $chronicle->story ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $chronicle->id], ['class' => 'btn btn-default btn-sm']) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $chronicle->id], ['class' => 'btn btn-default btn-sm']) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $chronicle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chronicle->id), 'class' => 'btn btn-default btn-sm']) ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
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
