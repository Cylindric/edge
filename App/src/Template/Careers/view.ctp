<?php
$this->Html->addCrumb('Career', '/careers');
$this->Html->addCrumb($career->name);
?>

<div class="btn-group" role="group" aria-label="Controls">
	<?= $this->Html->link(__('Edit Career'), ['action' => 'edit', $career->id], ['class' => 'btn btn-default']) ?>
	<?= $this->Form->postLink(__('Delete Career'), ['action' => 'delete', $career->id], ['confirm' => __('Are you sure you want to delete # {0}?', $career->id), 'class' => 'btn btn-default']) ?>
	<?= $this->Html->link(__('New Career'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<h3><?= h($career->name) ?></h3>
		<table class="table table-condensed">
			<tr>
				<th><?= __('Source') ?></th>
				<td><?= ($career->source->name) ?></td>
			</tr>
		</table>
	</div>
</div>