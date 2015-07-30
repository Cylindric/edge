<?php $this->assign('title', $character->name); ?>
<div class="row">
    <div class="col-md-2">
        <h3><?= __('Actions') ?></h3>
        <ul class="side-nav">
            <li><?= $this->Html->link(__('Edit Character'), ['action' => 'edit', $character->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Character'), ['action' => 'delete', $character->id], ['confirm' => __('Are you sure you want to delete # {0}?', $character->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Characters'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Character'), ['action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Growth'), ['controller' => 'Growth', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Growth'), ['controller' => 'Growth', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Training'), ['controller' => 'Training', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Training'), ['controller' => 'Training', 'action' => 'add']) ?> </li>
        </ul>
    </div>
    <div class="col-md-10">

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

        <div class="row">
            <div class="col-md-1 text-center stat">
                <div class="row value">
                    <?= $character->brawn ?>
                </div>
                <div class="row name">
                    BRAWN
                </div>
            </div>
            <div class="col-md-1 text-center stat">
                <div class="row value">
                    <?= $character->agility ?>
                </div>
                <div class="row name">
                    AGILITY
                </div>
            </div>
            <div class="col-md-1 text-center stat">
                <div class="row value">
                    <?= $character->intellect ?>
                </div>
                <div class="row name">
                    INTELLECT
                </div>
            </div>
            <div class="col-md-1 text-center stat">
                <div class="row value">
                    <?= $character->cunning ?>
                </div>
                <div class="row name">
                    CUNNING
                </div>
            </div>
            <div class="col-md-1 text-center stat">
                <div class="row value">
                    <?= $character->willpower ?>
                </div>
                <div class="row name">
                    WILLPOWER
                </div>
            </div>
            <div class="col-md-1 text-center stat">
                <div class="row value">
                    <?= $character->presence ?>
                </div>
                <div class="row name">
                    PRESENCE
                </div>
            </div>
        </div>

        <h3>Skills</h3>

        <div class="row">
            <?php foreach ($skills as $skill): ?>
                <div class="row">
                    <div class="col-md-4"><?= $skill->name ?> (<?= $skill->characteristic->code ?>)</div>
                    <div class="col-md-1"><?= $skill->level ?></div>
                    <div
                        class="col-md-7"><?= str_repeat($this->Html->image('dice-proficiency.png'), $skill->dice($character)[0]) ?><?= str_repeat($this->Html->image('dice-ability.png'), $skill->dice($character)[1]) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>