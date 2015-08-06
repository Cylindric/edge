<?php $this->Html->script('app', ['block' => true]); ?>
<?php $this->assign('title', $character->name); ?>

<?= $this->Form->create($character); ?>
<?= $this->Form->hidden('id'); ?>

<div class="row">
    <div class="col-md-12">



        <div class="row">
            <h2><?= h($character->name) ?></h2>
        </div>

        <h3>Characteristics</h3>

        <div class="row">
            <div class="col-md-2 text-center soak">
                <div class="row name">
                    SOAK
                </div>
                <div class="row value">
                    <?= $character->soak ?>
                </div>
            </div>
            <div class="col-md-2 text-center strain">
                <div class="row name">
                    STRAIN
                </div>
                <div class="row value">
                    <?= $character->strain ?>
                    <?= $character->strain ?>
                </div>
                <div class="row text-left subtitle">
                    THRESHOLD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CURRENT
                </div>
            </div>
        </div>

        <div class="row" id="stats_list_edit">
        </div>

        <div class="row" id="skills_list_edit">
        </div>
    </div>

</div>

<?= $this->Form->end() ?>
