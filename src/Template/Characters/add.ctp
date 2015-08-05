<div class="row">
	<div class="col-md-6">

		<?= $this->Form->create($character) ?>
		<legend><?= __('Add Character') ?></legend>
		<div class="form-group">
			<?= $this->Form->input('name', ['class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('species_id', ['options' => $species, 'class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('gender', ['class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('age', ['class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('height', ['class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('weight', ['class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('hair_colour', ['class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('eye_colour', ['class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('build', ['class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->input('home_planet', ['class' => 'form-control']); ?>
		</div>
		<div class="form-group">
			<?= $this->Form->label('notable_features') ?>
			<?= $this->Form->textarea('notable_features', ['class' => 'form-control']); ?>
		</div>

		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>

	</div>
</div>
