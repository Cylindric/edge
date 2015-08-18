<?php
$this->Html->script('rpgGroupEdit', ['block' => true]);
$this->Html->addCrumb('Groups', '/Groups');
$this->Html->addCrumb('View');
$this->assign('title', $group->name);
$editing = false;
?>
<div class="row">
    <div class="col-md-12 col-lg-10 col-lg-offset-1">

        <h1><?= $group->name ?></h1>

        <div class="col-md-12 text-center group_view">
            <div class="row title text-uppercase">
                <div class="col-md-4"></div>
                <div class="col-md-2">Soak</div>
                <div class="col-md-2">Strain</div>
                <div class="col-md-2">Wounds</div>
                <div class="col-md-2">Defence</div>
            </div>
            <?php foreach ($group->characters as $character): ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="row name">
                            <?= $this->Html->link($character->name, ['controller' => 'characters', 'action' => 'edit', $character->id]) ?>
                        </div>
                        <div class="row species">
                            <?= $character->species->name ?>
                            <?php if (!empty($character->career)): ?><?= $character->career->name ?><?php endif; ?><?php if (!empty($character->specialisation)): ?>, <?= $character->specialisation->name ?><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-2 value"><?= $character->soak ?></div>
                    <div class="col-md-2 value">
                        <div class="col-md-9">
                            <?= $character->strain_threshold ?>/<span id="strain_value"><?= $character->strain ?></span>
                        </div>
                        <div class="col-md-3 buttons">
                            <div class="col adjust">
                                <div><i class="increase glyphicon glyphicon-plus btn-skill-adjust" id="updatestatus_strain_<?= $character->id ?>_increase"></i></div>
                                <div><i class="decrease glyphicon glyphicon-minus btn-skill-adjust" id="updatestatus_strain_<?= $character->id ?>_decrease"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 value">
                        <div class="col-md-9">
                            <?= $character->wound_threshold ?>/<span id="wounds_value"><?= $character->wounds ?></span>
                        </div>
                        <div class="col-md-3 buttons">
                            <div class="col adjust">
                                <div><i class="increase glyphicon glyphicon-plus btn-skill-adjust" id="updatestatus_wounds_<?= $character->id ?>_increase"></i></div>
                                <div><i class="decrease glyphicon glyphicon-minus btn-skill-adjust" id="updatestatus_wounds_<?= $character->id ?>_decrease"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 value">
                        <?= $character->defence_melee ?>/<?= $character->defence_ranged ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php echo $this->Html->scriptBlock("
    $(document).on('click', 'i[id*=updatestatus_]', function () {
        var parts = $(this).attr('id').split('_');
        var status = parts[1];
        var char_id = parts[2];
        var action = parts[3];
        var delta = (action == 'increase' ? 1 : -1);
        var update = status + '_value';
        rpgApp.changeStatus(char_id, status, delta, update);
    });
            ", ['block' => true]); ?>

            <div class="row subtitle text-uppercase">
                <div class="col-md-4"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2 text-center">Mel/Rng</div>
            </div>
        </div>
        Total XP: <?= $this->Number->format($group->xp)?>.<br/>
        Total Obligation: <?= $this->Number->format($group->obligation)?>.<br/>
        Total Credits: <?= $this->Number->format($group->credits)?>.
    </div>
</div>
