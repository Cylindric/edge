<div class="col-xs-3 text-center status_block" id="<?= $names[0] ?>_box">
	<div class="row name text-uppercase">
		<?= $title ?>
	</div>

	<?php if ($editing): ?>
		<div class="row hidden-print">
			<div class="col-xs-5 col-xs-offset-1">
				<i class="btn btn-success btn-xs" id="<?= $names[0] ?>_increase" ng-click="changeAttribute('<?= $names[0] ?>', 1)">increase</i>
			</div>
			<div class="col-xs-5">
				<i class="btn btn-danger btn-xs" id="<?= $names[1] ?>_increase" ng-click="changeAttribute('<?= $names[1] ?>', 1)">increase</i>
			</div>
		</div>
	<?php endif; ?>

	<div class="row value">
		<div class="col-xs-5 col-xs-offset-1 text-center <?= empty($class) ? '' : $class[0] ?>">
			<?php if (empty($popover)): ?>
				<span id="<?= $names[0] ?>_value" ng-bind="<?= $names[0] ?>"><?= $values[0] ?></span>
			<?php else: ?>
				<span id="<?= $names[0] ?>_value" ng-bind="<?= $names[0] ?>" uib-popover-template="'myPopoverTemplate-<?= $names[0] ?>.html'" popover-title="<?= $title ?>" popover-trigger="mouseenter"><?= $values[0] ?></span>
			<?php endif; ?>
		</div>
		<div class="col-xs-5 text-center <?= empty($class) ? '' : $class[1] ?>">
			<span id="<?= $names[1] ?>_value" ng-bind="<?= $names[1] ?>"><?= $values[1] ?></span>
		</div>
	</div>

	<?php if ($editing): ?>
		<div class="row hidden-print">
			<div class="col-xs-5 col-xs-offset-1">
				<i class="btn btn-danger btn-xs" id="<?= $names[0] ?>_decrease" ng-click="changeAttribute('<?= $names[0] ?>', -1)">decrease</i>
			</div>
			<div class="col-xs-5">
				<i class="btn btn-success btn-xs" id="<?= $names[1] ?>_decrease" ng-click="changeAttribute('<?= $names[1] ?>', -1)">decrease</i>
			</div>
		</div>
	<?php endif; ?>
	<div class="visible-sm-block visible-xs-block row subtitle text-uppercase">
		<div class="col-xs-5 col-xs-offset-1"><?= substr($subtitles[0], 0, 3) ?></div>
		<div class="col-xs-5"><?= substr($subtitles[1], 0, 3) ?></div>
	</div>
	<div class="hidden-sm hidden-xs row subtitle text-uppercase">
		<div class="col-xs-5 col-xs-offset-1"><?= $subtitles[0] ?></div>
		<div class="col-xs-5"><?= $subtitles[1] ?></div>
	</div>
</div>


<?php if (!empty($popover)): ?>
	<script type="text/ng-template" id="myPopoverTemplate-<?= $names[0] ?>.html">
		<table class="table table-condensed">
			<tbody>
			<tr ng-repeat="(item,value) in <?= $popover ?>" class="{{(value > 0 ? 'success' : (value < 0 ? 'danger' : ''))}}">
				<td>{{item}}</td>
				<td class="text-right">{{value}}</td>
			</tr>
			</tbody>
		</table>
	</script>
<?php endif; ?>

