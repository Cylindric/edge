<div class="col-md-3 col-sm-3 col-xs-6 text-center status_block" id="<?= $name ?>_box">
    <div class="row name text-uppercase">
        <?= $name ?>
    </div>
    <?php if ($editing): ?>
        <div class="row">
            <div class="col-xs-3 col-xs-offset-3">
                <i class="decrease glyphicon glyphicon-plus btn-skill-adjust" id="<?= $name ?>_0_increase"></i>
            </div>
            <div class="col-xs-3">
                <i class="decrease glyphicon glyphicon-plus btn-skill-adjust" id="<?= $name ?>_1_increase"></i>
            </div>
        </div>
    <?php endif; ?>
    <div class="row value">
        <div class="col-xs-3 col-xs-offset-3"><span id="<?= $name ?>_0_value"><?= $values[0] ?></span></div>
        <div class="col-xs-3"><span id="<?= $name ?>_1_value"><?= $values[1] ?></span></div>
    </div>
    <?php if ($editing): ?>
        <div class="row">
            <div class="col-xs-3 col-xs-offset-3">
                <i class="increase glyphicon glyphicon-minus btn-skill-adjust" id="<?= $name ?>_0_decrease"></i>
            </div>
            <div class="col-xs-3">
                <i class="increase glyphicon glyphicon-minus btn-skill-adjust" id="<?= $name ?>_1_decrease"></i>
            </div>
        </div>
    <?php endif; ?>
    <div class="row subtitle text-uppercase">
        <div class="col-xs-6"><?= $subtitles[0] ?></div>
        <div class="col-xs-6"><?= $subtitles[1] ?></div>
    </div>
</div>
