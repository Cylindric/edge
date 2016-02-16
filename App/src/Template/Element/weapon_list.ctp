<h3>Weapons</h3>
<?php if (count($character_weapons) == 0): ?>
	None
<?php else: ?>
	<table class="table table-striped table-bordered">
		<thead>
		<tr>
			<th>Qty</th>
			<th>Weapon</th>
			<th>Skill</th>
			<th>Damage</th>
			<th>Range</th>
			<th>Crit</th>
			<th>Special</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($character_weapons as $weapon): ?>
			<tr>
				<td><?= $weapon->_joinData->quantity ?></td>
				<td><?= $weapon->name ?></td>
				<td><?= $weapon->skill->name ?></td>
				<td><?= $weapon->damage ?></td>
				<td><?= $weapon->range->name ?></td>
				<td><?= $weapon->crit ?></td>
				<td><?= $weapon->special ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>