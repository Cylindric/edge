<div class="col-md-3 col-sm-3 col-xs-6 text-center status_block" id="<?= $name ?>_box">
    <div class="row name text-uppercase">
        <?= $name ?>
    </div>
    <?php if ($editing): ?>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <i class="decrease glyphicon glyphicon-plus btn-skill-adjust" id="<?= $name ?>_0_increase"></i>
            </div>
        </div>
    <?php endif; ?>
    <div class="row value">
        <div class="col-xs-10 col-xs-offset-1"><span id="<?= $name ?>_0_value"><?= $value ?></span></div>
    </div>
    <?php if ($editing): ?>
        <div class="row text-uppercase">
            <div class="col-xs-10 col-xs-offset-1">
                <i class="increase glyphicon glyphicon-minus btn-skill-adjust" id="<?= $name ?>_0_decrease"></i>
            </div>
        </div>
    <?php endif; ?>
</div>
