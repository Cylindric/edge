<?php
$this->Html->addCrumb('Career', ['action' => 'index']);
$this->Html->addCrumb($career->name, ['action' => 'view', $career->id]);
?>
<div class="btn-group" role="group" aria-label="Controls">
	<?= $this->Form->postLink(
		__('Delete'),
		['action' => 'delete', $career->id],
		['confirm' => __('Are you sure you want to delete # {0}?', $career->id), 'class' => 'btn btn-default']
	)
	?>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<?= $this->Form->create($career) ?>
		<?= $this->Form->input('name'); ?>
		<?= $this->Form->input('source_id'); ?>
		<?= $this->Form->submit(); ?>
		<?= $this->Form->end() ?>

	</div>
</div>
