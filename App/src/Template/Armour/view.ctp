<?php
$this->Html->addCrumb('Armour', '/armour');
$this->Html->addCrumb($armour->name);
?>

<div class="btn-group" role="group" aria-label="Controls">
	<?= $this->Html->link(__('Edit Armour'), ['action' => 'edit', $armour->id], ['class' => 'btn btn-default']) ?>
	<?= $this->Form->postLink(__('Delete Armour'), ['action' => 'delete', $armour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $armour->id), 'class' => 'btn btn-default']) ?>
	<?= $this->Html->link(__('New Armour'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<h3><?= h($armour->name) ?></h3>
		<table class="table table-condensed">
			<tr>
				<th><?= __('Defence') ?></th>
				<td><?= $this->Number->format($armour->defence) ?></td>
			</tr>
			<tr>
				<th><?= __('Soak') ?></th>
				<td><?= $this->Number->format($armour->soak) ?></td>
			</tr>
			<tr>
				<th><?= __('Encumbrance') ?></th>
				<td><?= $this->Number->format($armour->encumbrance) ?></td>
			</tr>
			<tr>
				<th><?= __('Rarity') ?></th>
				<td><?= $this->Number->format($armour->rarity) ?></td>
			</tr>
			<tr>
				<th><?= __('HP') ?></th>
				<td><?= $this->Number->format($armour->hp) ?></td>
			</tr>
			<tr>
				<th><?= __('Value') ?></th>
				<td><?= $this->Number->format($armour->value) ?></td>
			</tr>
			<tr>
				<th><?= __('Restricted') ?></th>
				<td>
					<?php if ($armour->restricted): ?>
						<span class="label label-danger">Restricted</span>
					<?php else: ?>
						<span class="label label-success">Unrestricted</span>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th><?= __('Source') ?></th>
				<td><?= ($armour->source->name) ?></td>
			</tr>
		</table>
	</div>
</div>