<div class="row">
	<div class="col-md-12">

		<?= $this->Form->create($import, ['class' => 'form']) ?>

		<div class="form-group">
			<label for="json_data" class="control-label">Import Data</label>
			<div class="">
				<textarea class="form-control" name="json_data""></textarea>
			</div>
		</div>

		<div class="form-group">
			<div>
				<?= $this->Form->button(__('Import'), ['class' => 'btn btn-default']) ?>
			</div>
		</div>

		<?= $this->Form->end(); ?>
	</div>
</div>

<div class="row">
	<div class="col-md-12" style="height:2em;">
	</div>
</div>

<div class="row">
	<div class="col-md-12">

		<?php if (count($import->results) > 0): ?>
			<table class="table editable-condensed">
				<tr>
					<th>Table</th>
					<th>Record</th>
					<th>Status</th>
					<th>Errors</th>
				</tr>
				<?php foreach ($import->results as $result): ?>
					<?php
					switch ($result['status']) {
						case ('created'):
							$class = 'success';
							break;

						case ('skipped'):
							$class = 'warning';
							break;

						case ('failed'):
							$class = 'danger';
							break;

						default:
							$class = '';
							break;
					}

					?>
					<tr class="<?= $class ?>">
						<td><?= $result['table']; ?></td>
						<td><?= $result['record']; ?></td>
						<td><?= $result['status']; ?></td>
						<td><?= is_array($result['errors']) ? debug($result['errors']) : ''; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>

	</div>
</div>
