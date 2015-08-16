<?php $this->Html->addCrumb('Groups', '/Groups'); ?>
<?php $this->Html->addCrumb('View'); ?>
<?php $editing = false; ?>
<div class="row">
    <div class="col-md-12">

        <h1><?= $group->name ?></h1>

        <div class="col-xs-12 text-center status_block">
            <div class="row name text-uppercase">
                <div class="col-xs-2"></div>
                <div class="col-xs-1">Soak</div>
                <div class="col-xs-2">Strain</div>
                <div class="col-xs-2">Wounds</div>
                <div class="col-xs-2">Defence</div>
            </div>
            <?php foreach ($group->characters as $character): ?>
                <div class="row value">
                    <div class="col-xs-2"><?= $character->name ?></div>

                    <div class="col-xs-1"><?= $character->soak ?></div>

                    <div class="col-xs-1"><?= $character->strain_threshold ?></div>
                    <div class="col-xs-1"><?= $character->strain ?></div>

                    <div class="col-xs-1"><?= $character->wound_threshold ?></div>
                    <div class="col-xs-1"><?= $character->wounds ?></div>

                    <div class="col-xs-1"><?= $character->defence_melee ?></div>
                    <div class="col-xs-1"><?= $character->defence_ranged ?></div>
                </div>
            <?php endforeach; ?>
            <div class="row subtitle text-uppercase">
                <div class="col-xs-2"></div>

                <div class="col-xs-1"></div>

                <div class="col-xs-1">Threshold</div>
                <div class="col-xs-1">Current</div>

                <div class="col-xs-1">Threshold</div>
                <div class="col-xs-1">Current</div>

                <div class="col-xs-1">Melee</div>
                <div class="col-xs-1">Ranged</div>
            </div>
        </div>
    </div>
</div>
