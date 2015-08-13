<?php
$this->Html->addCrumb('Characters', '/characters');
$this->Html->addCrumb($character->name);
?>

<?php $this->assign('title', $character->name); ?>
<div class="row">
    <div class="col-xs-12">

        <div class="row">
            <div class="col-xs-12">
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
            <div class="col-xs-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_br ?></span>
                </div>
                <div class="row name">
                    BRAWN
                </div>
            </div>
            <div class="col-xs-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_ag ?></span>
                </div>
                <div class="row name">
                    AGILITY
                </div>
            </div>
            <div class="col-xs-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_int ?></span>
                </div>
                <div class="row name">
                    INTELLECT
                </div>
            </div>
            <div class="col-xs-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_cun ?></span>
                </div>
                <div class="row name">
                    CUNNING
                </div>
            </div>
            <div class="col-xs-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_will ?></span>
                </div>
                <div class="row name">
                    WILLPOWER
                </div>
            </div>
            <div class="col-xs-2 text-center stat">
                <div class="row value">
                    <span class="stat_edit_value"><?= $character->stat_pr ?></span>
                </div>
                <div class="row name">
                    PRESENCE
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-5">
                <?= $this->element('skill_list', [
                    'title' => 'General Skills',
                    'skilltype_id' => 1
                ]); ?>
            </div>

            <div class="col-xs-5">
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

        <?php if (count($character->talents) > 0) : ?>
            <div class="row">
                <div class="col-xs-5">
                    <?= $this->element('talent_list', [
                        'character_talents' => $character->talents
                    ]); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (count($character->notes) > 0) : ?>
            <div class="row">
                <div class="col-xs-5">
                    <?= $this->element('notes_list', [
                        'character_notes' => $character->notes
                    ]); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

</div>