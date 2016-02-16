<h3>Talents</h3>
<?php if (count($character_talents) == 0): ?>
	None
<?php else: ?>
	<table class="table table-striped table-bordered">
		<tbody>
		<?php foreach ($character_talents as $talent): ?>
			<tr>
				<td><?= $talent->name ?><?= $talent->ranked ? ' (' . $talent->_joinData->rank . ')' : '' ?></td>
			</tr>

		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>