<div class="btn-group" role="group" aria-label="Controls">
	<?= $this->Html->link(__('List Talents'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
	<?= $this->Html->link(__('List Characters'), ['controller' => 'Characters', 'action' => 'index'], ['class' => 'btn btn-default']) ?>

	<?= $this->Html->link(__('New Character'), ['controller' => 'Characters', 'action' => 'add'], ['class' => 'btn btn-default']) ?>

</div>

<?= $this->Form->create($talent, ['class' => 'form-horizontal']) ?>

<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Name</label>
	<div class="col-sm-10">
		<input type="name" class="form-control" id="name" placeholder="Name">
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<div class="checkbox">
			<?= $this->Form->input('ranked'); ?>
		</div>
	</div>
</div>

<div class="form-group">
	<label for="strain_per_rank" class="col-sm-2 control-label">Strain Per Rank</label>
	<div class="col-sm-1">
		<input type="number" class="form-control" id="strain_per_rank" placeholder="0">
	</div>
</div>

<div class="form-group">
	<label for="soak_per_rank" class="col-sm-2 control-label">Soak Per Rank</label>
	<div class="col-sm-1">
		<input type="number" class="form-control" id="soak_per_rank" placeholder="0">
	</div>
</div>

<div class="form-group">
	<label for="description" class="col-sm-2 control-label">Description</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="description" placeholder="Description">
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-default']) ?>
	</div>
</div>

<?= $this->Form->end() ?>
