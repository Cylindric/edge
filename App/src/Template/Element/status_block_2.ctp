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
        <div class="col-xs-5 col-xs-offset-1 text-center <?= empty($class) ? '' : $class[0] ?>"><span id="<?= $names[0] ?>_value" ng-bind="<?= $names[0] ?>"><?= $values[0] ?></span></div>
        <div class="col-xs-5 text-center <?= empty($class) ? '': $class[1] ?>"><span id="<?= $names[1] ?>_value" ng-bind="<?= $names[1] ?>"><?= $values[1] ?></span></div>
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
