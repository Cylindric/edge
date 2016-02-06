<?= $this->Flash->render('success'); ?>
<?= $this->Form->create($import, [ 'class' => 'form-horizontal']) ?>
<?= $this->Form->textarea('json_data');?>
<?= $this->Form->button('Submit');?>
<?= $this->Form->end(); ?>

<?php if (count($import->results) > 0): ?>
<table class="table editable-condensed">
	<tr>
		<th>Table</th>
		<th>Record</th>
		<th>Status</th>
		<th>Errors</th>
	</tr>
	<?php foreach($import->results as $result): ?>
		<?php
		switch($result['status']) {
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
		<tr class="<?=$class?>">
			<td><?= $result['table']; ?></td>
			<td><?= $result['record']; ?></td>
			<td><?= $result['status']; ?></td>
			<td><?= is_array($result['errors']) ? debug($result['errors']) : ''; ?></td>
		</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>