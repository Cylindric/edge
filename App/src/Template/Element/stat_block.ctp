<div class="text-center stat">
	<div class="row value">

			<i ng-show="stats.<?= $name ?> == 0" class="stat_edit_button glyphicon glyphicon-minus hidden-print"></i>
			<i ng-show="stats.<?= $name ?> > 0" class="stat_edit_button decrease glyphicon glyphicon-minus hidden-print" ng-click="changeStat('<?= $name ?>', -1)"></i>

		<span class="stat_edit_value">{{stats.<?= $name ?>}}</span>
		<i class="stat_edit_button increase glyphicon glyphicon-plus hidden-print" ng-click="changeStat('<?= $name ?>', 1)"></i>
	</div>
	<div class="row name">
		<?= $label ?>
	</div>
</div>
