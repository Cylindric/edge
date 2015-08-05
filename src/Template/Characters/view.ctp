<?php $this->assign('title', $character->name); ?>
<div class="row">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-12">
                <h2><?= h($character->name) ?>
				<?php if($canEdit):?> 
				<?= $this->Html->link('<span class="glyphicon glyphicon-edit" aria-label="Edit"></span>', ['action' => 'edit', $character->id], ['escape' => false]) ?></h2>
				<?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Characteristics</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12"></div>
                <div class="col-md-2 text-center soak">
                    <div class="row name">
                        SOAK
                    </div>
                    <div class="row value">
                        <span class="stat_edit_value"> <?= $character->soak ?></span>
                    </div>
                </div>
                <div class="col-md-2 text-center strain">
                    <div class="row name">
                        STRAIN
                    </div>
                    <div class="row value">
                        <span class="stat_edit_value"><?= $character->strain ?></span>
                        <span class="stat_edit_value"><?= $character->strain ?></span>
                    </div>
                    <div class="row text-left subtitle">
                        THRESHOLD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CURRENT
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_br ?></span>
                </div>
                <div class="row name">
                    BRAWN
                </div>
            </div>
            <div class="col-md-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_ag ?></span>
                </div>
                <div class="row name">
                    AGILITY
                </div>
            </div>
            <div class="col-md-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_int ?></span>
                </div>
                <div class="row name">
                    INTELLECT
                </div>
            </div>
            <div class="col-md-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_cun ?></span>
                </div>
                <div class="row name">
                    CUNNING
                </div>
            </div>
            <div class="col-md-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_will ?></span>
                </div>
                <div class="row name">
                    WILLPOWER
                </div>
            </div>
            <div class="col-md-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_pr ?></span>
                </div>
                <div class="row name">
                    PRESENCE
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <?= $this->element('skill_list', [
                    'title' => 'General Skills',
                    'skilltype_id' => 1
                ]); ?>
            </div>

            <div class="col-md-5">
                <?= $this->element('skill_list', [
                    'title' => 'Combat Skills',
                    'skilltype_id' => 2
                ]); ?>

                <?= $this->element('skill_list', [
                    'title' => 'Knowledge Skills',
                    'skilltype_id' => 3
                ]); ?>
            </div>
        </div>
    </div>

</div>