<?php
$this->Html->addCrumb('Characters', '/characters');
$this->Html->addCrumb($character->name);
$this->Html->script('rpgCharacterEdit', ['block' => true]);
$this->assign('title', $character->name);
?>

<?= $this->Form->create($character); ?>
<?= $this->Form->hidden('id'); ?>
<?= $this->Form->end() ?>

<div class="row">
    <div class="col-md-12">

        <div class="row">
            <h2><?= h($character->name) ?></h2>
        </div>

        <?= $this->element('status_block', [
            'character' => $character
        ]); ?>

        <h3>Characteristics</h3>

        <div class="row" id="stats_list_edit">
        </div>

        <div class="row" id="skills_list_edit">
        </div>

        <div class="row" id="talents_list_edit">
        </div>

        <div class="row" id="notes_list_edit">
        </div>
    </div>

</div>
