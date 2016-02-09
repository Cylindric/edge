<?php
$this->Html->addCrumb('Characters', ['action' => '']);
$this->Html->addCrumb($character->name);
$this->assign('title', $character->name);
$this->Html->script('rpgCharacterEdit', ['block' => true]);
?>
<?= $this->Form->create($character); ?>
<?= $this->Form->hidden('id'); ?>
<?= $this->Form->end() ?>

<?php $this->assign('title', $character->name); ?>
<div class="row" ng-controller="CharacterCtrl">
    <div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">

        <div class="row">
            <div class="col-md-12">
                <h2><?= h($character->name) ?>
                    <?php if ($canEdit): ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-edit" aria-label="Edit"></span>', ['action' => 'edit', $character->id], ['escape' => false, 'class' => 'hidden-print']) ?></h2>
                <?php endif; ?>
            </div>
        </div>

        <?= $this->element('status_block', [
            'character' => $character,
        ]); ?>

        <h3>Characteristics</h3>

        <div class="row">
            <div class="col-md-2 col-sm-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_br ?></span>
                </div>
                <div class="row name">
                    BRAWN
                </div>
            </div>
            <div class="col-md-2 col-sm-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_ag ?></span>
                </div>
                <div class="row name">
                    AGILITY
                </div>
            </div>
            <div class="col-md-2 col-sm-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_int ?></span>
                </div>
                <div class="row name">
                    INTELLECT
                </div>
            </div>
            <div class="col-md-2 col-sm-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_cun ?></span>
                </div>
                <div class="row name">
                    CUNNING
                </div>
            </div>
            <div class="col-md-2 col-sm-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_will ?></span>
                </div>
                <div class="row name">
                    WILLPOWER
                </div>
            </div>
            <div class="col-md-2 col-sm-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_pr ?></span>
                </div>
                <div class="row name">
                    PRESENCE
                </div>
            </div>
        </div>

        <div class="row breakbefore">
            <div class="col-sm-5 col-md-5">
                <?= $this->element('skill_list', [
                    'title' => 'General Skills',
                    'skilltype_id' => 1
                ]); ?>
            </div>

            <div class="col-sm-5 col-md-5">
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

        <div class="row breakbefore">
            <div class="col-md-12">
                <?= $this->element('weapon_list', [
                    'character_weapons' => $character->weapons
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $this->element('armour_list', [
                    'character_armour' => $character->armour
                ]); ?>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-5 col-md-5">
                <?= $this->element('talent_list', [
                    'character_talents' => $character->talents
                ]); ?>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-5 col-md-5">
                <?= $this->element('notes_list', [
                    'character_notes' => $character->notes
                ]); ?>
            </div>
        </div>


        <div class="row" id="bio">
            <div class="col-md-12">
                <h3>Bio</h3>
                <?= $this->Text->autoParagraph($character->biography) ?>
            </div>
        </div>


    </div>

</div>