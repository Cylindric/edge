<?php
$editing = $this->request->params['action'] == 'edit';
?>
<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-6 text-center stat_single" id="soak_box">
        <div class="row name">
            SOAK
        </div>
        <div class="row value">
            <span><?= $character->soak ?></span>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 text-center stat_double" id="strain_box">
        <div class="row name">
            STRAIN
        </div>
        <div class="row value">
            <div class="col-xs-6">
                <?= $character->strainThreshold ?>
            </div>
            <div class="col-xs-6">
                <?php if ($editing): ?><i class="increase glyphicon glyphicon-minus btn-skill-adjust"
                                          id="strain_decrease"></i><?php endif; ?>
                <span><?= $character->strain ?></span>
                <?php if ($editing): ?><i class="decrease glyphicon glyphicon-plus btn-skill-adjust"
                                          id="strain_increase"></i><?php endif; ?>
            </div>
        </div>
        <div class="row subtitle">
            <div class="col-xs-6">THRESHOLD</div>
            <div class="col-xs-6">CURRENT</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 text-center stat_double" id="wounds_box">
        <div class="row name">
            WOUNDS
        </div>
        <div class="row value">
            <div class="col-xs-6"><?= $character->woundThreshold ?></div>
            <div class="col-xs-6">
                <?php if ($editing): ?><i class="increase glyphicon glyphicon-minus btn-skill-adjust"
                                          id="wounds_decrease"></i><?php endif; ?>
                <span><?= $character->wounds ?></span>
                <?php if ($editing): ?><i class="decrease glyphicon glyphicon-plus btn-skill-adjust"
                                          id="wounds_increase"></i><?php endif; ?>
            </div>
        </div>
        <div class="row subtitle">
            <div class="col-xs-6">THRESHOLD</div>
            <div class="col-xs-6">CURRENT</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 text-center stat_double" id="defence_box">
        <div class="row name">
            DEFENCE
        </div>
        <div class="row value">
            <div class="col-xs-6"><?= $character->defence_melee ?></div>
            <div class="col-xs-6"><?= $character->defence_ranged ?></div>
        </div>
        <div class="row subtitle">
            <div class="col-xs-6">MELEE</div>
            <div class="col-xs-6">RANGED</div>
        </div>
    </div>
</div>
