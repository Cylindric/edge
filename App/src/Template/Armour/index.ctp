<div class="btn-group" role="group" aria-label="Controls">
	<?= $this->Html->link(__('New Armour'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
</div>

<h3><?= __('Armour') ?></h3>

<div class="row">
	<div class="col-md-12">
		<table class="table table-condensed table-hover">
			<thead>
			<tr>
				<th><?= $this->Paginator->sort('name') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('defence') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('soak') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('encumbrance') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('rarity') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('hp') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('value') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('restricted') ?></th>
				<th class="actions"><?= __('Actions') ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($armour as $armour): ?>
				<tr>
					<td><?= h($armour->name) ?></td>
					<td class="text-center"><?= $this->Number->format($armour->defence) ?></td>
					<td class="text-center"><?= $this->Number->format($armour->soak) ?></td>
					<td class="text-center"><?= $this->Number->format($armour->encumbrance) ?></td>
					<td class="text-center"><?= $this->Number->format($armour->rarity) ?></td>
					<td class="text-center"><?= $this->Number->format($armour->hp) ?></td>
					<td class="text-right"><?= $this->Number->format($armour->value) ?></td>
					<td class="text-center"><span class="label label-danger <?= $armour->restricted ? '' : 'hidden' ?>">Restricted</span></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $armour->id], ['class' => 'btn btn-default btn-sm']) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $armour->id], ['class' => 'btn btn-default btn-sm']) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $armour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $armour->id), 'class' => 'btn btn-default btn-sm']) ?>
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
