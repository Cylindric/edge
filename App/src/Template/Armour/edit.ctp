<?php
$this->Html->addCrumb('Armour', '/armour');
$this->Html->addCrumb($armour->name, ['action' => 'view', $armour->id]);
?>
<div class="btn-group" role="group" aria-label="Controls">
	<?= $this->Form->postLink(
		__('Delete'),
		['action' => 'delete', $armour->id],
		['confirm' => __('Are you sure you want to delete # {0}?', $armour->id), 'class' => 'btn btn-default']
	)
	?>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<?= $this->Form->create($armour) ?>
		<?= $this->Form->input('name'); ?>
		<?= $this->Form->input('defence'); ?>
		<?= $this->Form->input('soak'); ?>
		<?= $this->Form->input('encumbrance'); ?>
		<?= $this->Form->input('rarity'); ?>
		<?= $this->Form->input('hp'); ?>
		<?= $this->Form->input('value'); ?>
		<?= $this->Form->input('source_id'); ?>
		<?= $this->Form->submit(); ?>
		<?= $this->Form->end() ?>

	</div>
</div>
