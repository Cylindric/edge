<div class="col-xs-3 text-center status_block" id="<?= $name ?>_box">
    <div class="row name text-uppercase">
        <?= $name ?>
    </div>
    <?php if ($editing): ?>
        <div class="row hidden-print">
            <div class="col-sm-10 col-sm-offset-1">
                <i class="btn btn-success btn-xs" id="<?= $name ?>_0_increase" ng-click="changeAttribute('<?= $name ?>', 1)">increase</i>
            </div>
        </div>
    <?php endif; ?>
    <div class="row value">
        <div class="col-sm-10 col-sm-offset-1 <?= empty($class) ? '' : $class ?>">
            <span id="<?= $name ?>_0_value" ng-bind="<?= $name ?>"><?= $value ?></span>
        </div>
    </div>
    <?php if ($editing): ?>
        <div class="row hidden-print">
            <div class="col-sm-10 col-sm-offset-1">
                <i class="btn btn-danger btn-xs" id="<?= $name ?>_0_decrease" ng-click="changeAttribute('<?= $name ?>', -1)">decrease</i>
            </div>
        </div>
    <?php endif; ?>
</div>
