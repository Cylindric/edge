<div class="row">
	<div class="col-md-12">

		<?= $this->Form->create($character) ?>
		<legend><?= __('Add Character') ?></legend>
		<?= $this->Form->input('name'); ?>
		<?= $this->Form->input('species_id'); ?>
		<?= $this->Form->input('career_id'); ?>
		<?= $this->Form->input('specialisation_id'); ?>
		<?= $this->Form->input('gender'); ?>
		<?= $this->Form->input('age'); ?>
		<?= $this->Form->input('height'); ?>
		<?= $this->Form->input('weight'); ?>
		<?= $this->Form->input('hair_colour'); ?>
		<?= $this->Form->input('eye_colour'); ?>
		<?= $this->Form->input('build'); ?>
		<?= $this->Form->input('home_planet'); ?>

		<?= $this->Form->label('notable_features') ?>
		<?= $this->Form->textarea('notable_features'); ?>

		<?= $this->Form->submit(); ?>
		<?= $this->Form->end(); ?>

	</div>
</div>
