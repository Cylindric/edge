<div class="text-center stat">
	<div class="row value">
		<?php if ($value <= 0): ?>
			<i class="stat_edit_button glyphicon glyphicon-minus hidden-print"></i>
		<?php else: ?>
			<i class="stat_edit_button decrease glyphicon glyphicon-minus hidden-print" id="statdecrease_<?= $name ?>"></i>
		<?php endif; ?>
		<span class="stat_edit_value"><?= $value ?></span>
		<i class="stat_edit_button increase glyphicon glyphicon-plus hidden-print" id="statincrease_<?= $name ?>"></i>
	</div>
	<div class="row name">
		<?= $label ?>
	</div>
</div>
