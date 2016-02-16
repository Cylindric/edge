<div class="btn-group" role="group" aria-label="Controls">
	<?= $this->Html->link(__('New Career'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
</div>

<h3><?= __('Career') ?></h3>

<div class="row">
	<div class="col-md-12">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?= $this->Paginator->sort('name') ?></th>
				<th class="actions"><?= __('Actions') ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($careers as $career): ?>
				<tr>
					<td><?= h($career->name) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $career->id], ['class' => 'btn btn-default btn-sm']) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $career->id], ['class' => 'btn btn-default btn-sm']) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $career->id], ['confirm' => __('Are you sure you want to delete # {0}?', $career->id), 'class' => 'btn btn-default btn-sm']) ?>
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
