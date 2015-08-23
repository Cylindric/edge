<?php $this->Html->addCrumb('Groups', '/Groups'); ?>
<?php $this->Html->addCrumb('View'); ?>
<?php $editing = false; ?>
<div class="row">
    <div class="col-md-12">

        <h1><?= $group->name ?></h1>

        <div class="col-xs-12 text-center group_view">
            <div class="row title text-uppercase">
                <div class="col-xs-4"></div>
                <div class="col-xs-2">Soak</div>
                <div class="col-xs-2">Strain</div>
                <div class="col-xs-2">Wounds</div>
                <div class="col-xs-2">Defence</div>
            </div>
            <?php foreach ($group->characters as $character): ?>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="row name">
                            <?= $this->Html->link($character->name, ['controller' => 'characters', 'action' => 'view', $character->id]) ?>
                        </div>
                        <div class="row species">
                            <?= $character->species->name ?>
                            <?php if(!empty($character->career)):?><?= $character->career->name ?><?php endif; ?><?php if(!empty($character->specialisation)):?>, <?= $character->specialisation->name ?><?php endif; ?>
                            (<?= $character->user->username ?>)
                        </div>
                    </div>
                    <div class="col-xs-2 value"><?= $character->soak ?></div>
                    <div class="col-xs-2 value"><?= $character->strain_threshold ?>/<?= $character->strain ?></div>
                    <div class="col-xs-1 value"><?= $character->strain_threshold ?>/<?= $character->strain ?></div>
                    <div class="col-xs-2 value"><?= $character->wound_threshold ?>/<?= $character->wounds ?></div>
                    <div class="col-xs-2 value"><?= $character->defence_melee ?>/<?= $character->defence_ranged ?></div>
                </div>
            <?php endforeach; ?>
            <div class="row subtitle text-uppercase">
                <div class="col-xs-4"></div>
                <div class="col-xs-2"></div>
                <div class="col-xs-2"></div>
                <div class="col-xs-2"></div>
                <div class="col-xs-2 text-center">Mel/Rng</div>
            </div>
        </div>
    </div>
</div>
