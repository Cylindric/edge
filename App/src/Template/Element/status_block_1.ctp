<div class="col-xs-3 text-center status_block" id="<?= $name ?>_box">
	<div class="row name text-uppercase">
		<?= $title ?>
	</div>

	<?php if ($editing): ?>
		<div class="row hidden-print">
			<div class="col-sm-10 col-sm-offset-1">
				<i class="btn btn-success btn-xs" id="<?= $name ?>_increase" ng-click="changeAttribute('<?= $name ?>', 1)">increase</i>
			</div>
		</div>
	<?php endif; ?>

	<div class="row value">
		<div class="col-sm-10 col-sm-offset-1 <?= empty($class) ? '' : $class ?>">
			<?php if (empty($popover)): ?>
				<span id="<?= $name ?>_value" ng-bind="<?= $name ?>"><?= $value ?></span>
			<?php else: ?>
				<span id="<?= $name ?>_value" ng-bind="<?= $name ?>" uib-popover-template="'myPopoverTemplate-<?= $name ?>.html'" popover-title="<?= $title ?>" popover-trigger="mouseenter"><?= $value ?></span>
			<?php endif; ?>
		</div>
	</div>

	<?php if ($editing): ?>
		<div class="row hidden-print">
			<div class="col-sm-10 col-sm-offset-1">
				<i class="btn btn-danger btn-xs" id="<?= $name ?>_decrease" ng-click="changeAttribute('<?= $name ?>', -1)">decrease</i>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php if (!empty($popover)): ?>
	<script type="text/ng-template" id="myPopoverTemplate-<?= $name ?>.html">
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