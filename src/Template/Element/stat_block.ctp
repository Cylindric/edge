<div class="col-md-2 text-center stat">
	<div class="row value">
		<?php if ($value <= 1): ?>
			<i class="stat_edit_button fa fa-minus-square"></i>
		<?php else: ?>
			<i class="stat_edit_button decrease fa fa-minus-square" id="statdecrease_<?= $name ?>"></i>
		<?php endif; ?>
		<span class="stat_edit_value"><?= $value ?></span>
		<i class="stat_edit_button increase fa fa-plus-square" id="statincrease_<?= $name ?>"></i>
	</div>
	<div class="row name">
		<?= $label ?>
	</div>
</div>
