<?php
$this->Html->addCrumb('Species', '/species');
$this->Html->addCrumb($species->name, ['action' => 'view', $species->id]);
?>
<div class="btn-group" role="group" aria-label="Controls">
	<?= $this->Form->postLink(
		__('Delete'),
		['action' => 'delete', $species->id],
		['confirm' => __('Are you sure you want to delete # {0}?', $species->id), 'class' => 'btn btn-default']
	)
	?>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<?= $this->Form->create($species, ['class' => 'form-horizontal']) ?>

		<div class="form-group">
			<label for="name" class="col-md-4 control-label">Name</label>
			<div class="col-md-8">
				<input type="text" class="form-control" id="name" placeholder="Name" value="<?= $species->name ?>">
			</div>
		</div>

		<div class="form-group">
			<label for="base_wound" class="col-md-4 control-label">Base Wound</label>
			<div class="col-md-4">
				<input type="number" class="form-control" id="base_wound" placeholder="0" value="<?= $species->base_wound ?>">
			</div>
		</div>

		<div class="form-group">
			<label for="base_strain" class="col-md-4 control-label">Base Strain</label>
			<div class="col-md-4">
				<input type="number" class="form-control" id="base_strain" placeholder="0" value="<?= $species->base_strain ?>">
			</div>
		</div>

		<div class="form-group">
			<label for="base_xp" class="col-md-4 control-label">Base XP</label>
			<div class="col-md-4">
				<input type="number" class="form-control" id="base_xp" placeholder="0" value="<?= $species->base_xp ?>">
			</div>
		</div>

		<div class="form-group">
			<label for="stat_br" class="col-md-4 control-label">Brawn</label>
			<div class="col-md-4">
				<input type="number" class="form-control" id="stat_br" placeholder="0" value="<?= $species->stat_br ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="stat_ag" class="col-md-4 control-label">Agility</label>
			<div class="col-md-4">
				<input type="number" class="form-control" id="stat_ag" placeholder="0" value="<?= $species->stat_ag ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="stat_br" class="col-md-4 control-label">Intellect</label>
			<div class="col-md-4">
				<input type="number" class="form-control" id="stat_br" placeholder="0" value="<?= $species->stat_br ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="stat_int" class="col-md-4 control-label">Cunning</label>
			<div class="col-md-4">
				<input type="number" class="form-control" id="stat_int" placeholder="0" value="<?= $species->stat_int ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="stat_will" class="col-md-4 control-label">Willpower</label>
			<div class="col-md-4">
				<input type="number" class="form-control" id="stat_will" placeholder="0" value="<?= $species->stat_will ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="stat_pr" class="col-md-4 control-label">Presence</label>
			<div class="col-md-4">
				<input type="number" class="form-control" id="stat_pr" placeholder="0" value="<?= $species->stat_pr ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="source" class="col-md-4 control-label">Source</label>
			<div class="col-md-8">
				<select name="source" class="form-control">
					<?php foreach($sources as $id => $name):?>
					<option value="<?=$id?>" <?=$species->source_id == $id ? 'selected="selected"' : '';?>><?=$name?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<?= $this->Form->button(__('Save'), ['class' => 'btn btn-default']) ?>
			</div>
		</div>

		<?= $this->Form->end() ?>

	</div>
</div>
