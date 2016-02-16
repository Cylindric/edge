<div class="btn-group" role="group" aria-label="Controls">
	<?= $this->Html->link(__('New Species'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
</div>

<h3><?= __('Species') ?></h3>

<div class="row">
	<div class="col-md-12">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?= $this->Paginator->sort('name') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('base_wound', 'Wounds') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('base_strain', 'Strain') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('base_xp', 'XP') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('stat_br', 'BR') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('stat_ag', 'AG') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('stat_int', 'INT') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('stat_cun', 'CUN') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('stat_will', 'WILL') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('stat_pr', 'PR') ?></th>
				<th class="actions"><?= __('Actions') ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($species as $species): ?>
				<tr>
					<td><?= h($species->name) ?></td>
					<td class="text-center"><?= $this->Number->format($species->base_wound) ?></td>
					<td class="text-center"><?= $this->Number->format($species->base_strain) ?></td>
					<td class="text-center"><?= $this->Number->format($species->base_xp) ?></td>
					<td class="text-center"><?= $this->Number->format($species->stat_br) ?></td>
					<td class="text-center"><?= $this->Number->format($species->stat_ag) ?></td>
					<td class="text-center"><?= $this->Number->format($species->stat_int) ?></td>
					<td class="text-center"><?= $this->Number->format($species->stat_cun) ?></td>
					<td class="text-center"><?= $this->Number->format($species->stat_will) ?></td>
					<td class="text-center"><?= $this->Number->format($species->stat_pr) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $species->id], ['class' => 'btn btn-default btn-sm']) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $species->id], ['class' => 'btn btn-default btn-sm']) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $species->id], ['confirm' => __('Are you sure you want to delete # {0}?', $species->id), 'class' => 'btn btn-default btn-sm']) ?>
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
