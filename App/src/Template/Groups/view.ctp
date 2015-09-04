<?php $this->Html->addCrumb('Groups', '/Groups'); ?>
<?php $this->Html->addCrumb('View'); ?>
<?php $editing = false; ?>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">

        <h1><?= $group->name ?></h1>

        <div class="col-sm-12 text-center group_view">
            <div class="row title text-uppercase">
                <div class="col-sm-4 col-md-4"></div>
                <div class="col-sm-2 col-md-2">Soak</div>
                <div class="col-sm-3 col-md-3">Strain</div>
                <div class="col-sm-3 col-md-3">Wounds</div>
            </div>
            <?php foreach ($group->characters as $character): ?>
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="row name">
                            <span class="hidden-print"><?= $this->Html->link($character->name, ['controller' => 'characters', 'action' => 'view', $character->id]) ?></span>
                            <span class="visible-print"><?= $character->name ?></span>
                        </div>
                        <div class="row species">
                            <?= $character->species->name ?>
                            <?php if (!empty($character->career)): ?><?= $character->career->name ?><?php endif; ?><?php if (!empty($character->specialisation)): ?>, <?= $character->specialisation->name ?><?php endif; ?>
                            (<?= $character->user->username ?>)
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2 value"><?= $character->soak ?></div>
                    <div class="col-sm-3 col-md-3 value"><?= $character->strain_threshold ?>/<span><?= $character->strain ?></span></div>
                    <div class="col-sm-3 col-md-3 value"><?= $character->wound_threshold ?>/<span id="wounds_<?= $character->id ?>_value"><?= $character->wounds ?></span></div>
                </div>
            <?php endforeach; ?>
            <div class="row subtitle text-uppercase">
                <div class="col-xs-4">&nbsp;</div>
                <div class="col-xs-2"></div>
                <div class="col-xs-3"></div>
                <div class="col-xs-3"></div>
            </div>
        </div>
    </div>
</div>
