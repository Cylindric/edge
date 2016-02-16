<?php
$this->Html->script('rpgGroupEdit', ['block' => true]);
$this->Html->addCrumb('Groups', '/Groups');
$this->Html->addCrumb('Edit');
$this->assign('title', $group->name);
$editing = false;
?>
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
            <?php foreach ($group->characters_groups as $character_group): ?>
                <?php $character = $character_group->character; ?>
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="row name">
                            <span class="hidden-print"><?= $this->Html->link($character->name, ['controller' => 'characters', 'action' => 'edit', $character->id]) ?></span>
                            <span class="visible-print"><?= $character->name ?></span>
                        </div>
                        <div class="row species">
                            <?= $character->species->name ?>
                            <?php if (!empty($character->career)): ?><?= $character->career->name ?><?php endif; ?><?php if (!empty($character->specialisation)): ?>, <?= $character->specialisation->name ?><?php endif; ?>
                            (<?= $character->user->username ?>)
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2 value"><?= $character->totalSoak ?></div>
                    <div class="col-sm-3 col-md-3">
                        <div class="col-sm-8 value">
                            <?= $character->totalStrainThreshold ?>/<span id="strain_<?= $character->id ?>_value"><?= $character->strain ?></span>
                        </div>
                        <div class="col-sm-2 buttons">
                            <i class="btn btn-md btn-danger btn-skill-adjust" id="updateattribute_strain_<?= $character->id ?>_increase">increase</i>
                            <i class="btn btn-md btn-success btn-skill-adjust" id="updateattribute_strain_<?= $character->id ?>_decrease">decrease</i>
                        </div>
                    </div>


                    <div class="col-sm-3 col-md-3">
                        <div class="col-sm-8 value">
                            <?= $character->totalWoundThreshold ?>/<span id="wounds_<?= $character->id ?>_value"><?= $character->wounds ?></span>
                        </div>
                        <div class="col-sm-4 buttons">
                            <div><i class="btn btn-md btn-success btn-skill-adjust" id="updateattribute_wounds_<?= $character->id ?>_increase">increase</i></div>
                            <div><i class="btn btn-md btn-danger btn-skill-adjust" id="updateattribute_wounds_<?= $character->id ?>_decrease">decrease</i></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php echo $this->Html->scriptBlock("
    $(document).on('click', 'i[id*=updateattribute_]', function () {
        var parts = $(this).attr('id').split('_');
        var status = parts[1];
        var char_id = parts[2];
        var action = parts[3];
        var delta = (action == 'increase' ? 1 : -1);
        var update = status + '_' + char_id + '_value';
        rpgApp.changeAttribute(char_id, status, delta, update);
    });
            ", ['block' => true]); ?>

            <div class="row subtitle text-uppercase">
                <div class="col-sm-4 col-md-4">&nbsp;</div>
                <div class="col-sm-2 col-md-2"></div>
                <div class="col-sm-3 col-md-3"></div>
                <div class="col-sm-3 col-md-3"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <h2>Weaponry</h2>
            <table class="table table-condensed">
                <tr>
                    <th>Character</th>
                    <th>Weapon</th>
                    <th>Range</th>
                    <th class="text-right">Damage</th>
                    <th class="text-right">Crit</th>
                    <th>Dice Pool</th>
                    <th>Special</th>
                </tr>
                <?php foreach ($weapons as $weapon): ?>
                    <tr>
                        <td class="text-capitalize"><?= $weapon->_matchingData['Characters']->name ?></td>
                        <td class="text-capitalize"><?= $weapon->name ?></td>
                        <td class="text-capitalize"><?= $weapon->range->name ?></td>
                        <td class="text-right"><?= $weapon->damage ?></td>
                        <td class="text-right"><?= $weapon->crit ?></td>
                        <td><?= $this->RpgText->dice($weapon->skill->dice($weapon->_matchingData['Characters'])) ?></td>
                        <td><?= $weapon->special ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 col-md-3">
            <h2>XP</h2>
            <table class="table table-condensed">
                <?php $total = 0; ?>
                <?php foreach ($group->characters_groups as $character_group): $total += $character_group->character->totalXp; ?>
                    <tr>
                        <td class="text-capitalize"><?= $character_group->character->name ?></td>
                        <td class="text-right"><?= $this->Number->format($character_group->character->totalXp) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="success">
                    <td class="text-capitalize">Total</td>
                    <td class="text-right"><?= $total ?></td>
                </tr>
            </table>
        </div>

        <div class="col-sm-3 col-md-3">
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

        <div class="col-sm-3 col-md-3">
            <h2>Credits</h2>
            <table class="table table-condensed">
                <?php $total = 0; ?>
                <?php foreach ($group->characters_groups as $character_group): $total += $character_group->character->totalCredits; ?>
                    <tr>
                        <td class="text-capitalize"><?= $character_group->character->name ?></td>
                        <td class="text-right"><?= $this->Number->format($character_group->character->totalCredits) ?></td>
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
