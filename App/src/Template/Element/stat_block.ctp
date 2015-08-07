<div class="col-md-2 text-center stat">
	<div class="row value">
		<?php if ($value <= 1): ?>
			<i class="stat_edit_button glyphicon glyphicon-minus"></i>
		<?php else: ?>
			<i class="stat_edit_button decrease glyphicon glyphicon-minus" id="statdecrease_<?= $name ?>"></i>
		<?php endif; ?>
		<span class="stat_edit_value"><?= $value ?></span>
		<i class="stat_edit_button increase glyphicon glyphicon-plus" id="statincrease_<?= $name ?>"></i>
	</div>
	<div class="row name">
		<?= $label ?>
	</div>
</div>