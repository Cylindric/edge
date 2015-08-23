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
                            (<?= $character->user->username ?>)
                        </div>
                    </div>
                    <div class="col-md-2 value"><?= $character->soak ?></div>
                    <div class="col-md-2 value">
                        <div class="col-md-9">
                            <?= $character->strain_threshold ?>/<span id="strain_value"><?= $character->strain ?></span>
                        </div>
                        <div class="col-md-3 buttons">
                            <div class="col adjust">
                                <div><i class="increase glyphicon glyphicon-plus btn-skill-adjust"
                                        id="updatestatus_strain_<?= $character->id ?>_increase"></i></div>
                                <div><i class="decrease glyphicon glyphicon-minus btn-skill-adjust"
                                        id="updatestatus_strain_<?= $character->id ?>_decrease"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 value">
                        <div class="col-md-9">
                            <?= $character->wound_threshold ?>/<span id="wounds_value"><?= $character->wounds ?></span>
                        </div>
                        <div class="col-md-3 buttons">
                            <div class="col adjust">
                                <div><i class="increase glyphicon glyphicon-plus btn-skill-adjust"
                                        id="updatestatus_wounds_<?= $character->id ?>_increase"></i></div>
                                <div><i class="decrease glyphicon glyphicon-minus btn-skill-adjust"
                                        id="updatestatus_wounds_<?= $character->id ?>_decrease"></i></div>
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
    </div>
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <h2>XP</h2>
            <table class="table table-condensed">
                <?php $total = 0; ?>
                <?php foreach ($group->characters as $character): $total += $character->xp; ?>
                    <tr>
                        <td class="text-capitalize"><?= $character->name ?></td>
                        <td class="text-right"><?= $character->xp ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="success">
                    <td class="text-capitalize">Total</td>
                    <td class="text-right"><?= $total ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-3">
            <h2>Obligation</h2>
            <table class="table table-condensed">
                <?php $total = 0; ?>
                <?php foreach ($obligations as $obligation): $total += $obligation->value; ?>
                    <tr>
                        <td class="text-capitalize"><?= $obligation->type ?></td>
                        <td class="text-right"><?= $obligation->value ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="success">
                    <td class="text-capitalize">Total</td>
                    <td class="text-right"><?= $total ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-3">
            <h2>Credits</h2>
            <table class="table table-condensed">
                <?php $total = 0; ?>
                <?php foreach ($group->characters as $character): $total += $character->credits; ?>
                    <tr>
                        <td class="text-capitalize"><?= $character->name ?></td>
                        <td class="text-right"><?= $this->Number->format($character->credits) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="success">
                    <td class="text-capitalize">Total</td>
                    <td class="text-right"><?= $this->Number->format($total) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
