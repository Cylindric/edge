<div class="col-xs-3 text-center status_block" id="<?= $name ?>_box">
    <div class="row name text-uppercase">
        <?= $name ?>
    </div>

    <?php if ($editing): ?>
        <div class="row">
            <div class="col-xs-5 col-xs-offset-1">
                <i class="btn btn-success btn-xs" id="<?= $name ?>_0_increase">increase</i>
            </div>
            <div class="col-xs-5">
                <i class="btn btn-danger btn-xs" id="<?= $name ?>_1_increase">increase</i>
            </div>
        </div>
    <?php endif; ?>

    <div class="row value">
        <div class="col-xs-5 col-xs-offset-1 text-center"><span id="<?= $name ?>_0_value"><?= $values[0] ?></span></div>
        <div class="col-xs-5 text-center"><span id="<?= $name ?>_1_value"><?= $values[1] ?></span></div>
    </div>

    <?php if ($editing): ?>
        <div class="row">
            <div class="col-xs-5 col-xs-offset-1">
                <i class="btn btn-danger btn-xs" id="<?= $name ?>_0_decrease">decrease</i>
            </div>
            <div class="col-xs-5">
                <i class="btn btn-success btn-xs" id="<?= $name ?>_0_decrease">decrease</i>
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
