<?php $this->assign('title', $character->name); ?>
<div class="row">
    <div class="col-md-4">
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
    <div class="col-md-6">

        <div class="row">
            <h2><?= h($character->name) ?></h2>
        </div>

        <h3>Characteristics</h3>

        <div class="row">
            <div class="col-md-2 text-center">
                Brawn<br/><?= $character->brawn ?>
            </div>
            <div class="col-md-2 text-center">
                Agility<br/><?= $character->agility ?>
            </div>
            <div class="col-md-2 text-center">
                Intellect<br/><?= $character->intellect ?>
            </div>
            <div class="col-md-2 text-center">
                Cunning<br/><?= $character->cunning ?>
            </div>
            <div class="col-md-2 text-center">
                Willpower<br/><?= $character->willpower ?>
            </div>
            <div class="col-md-2 text-center">
                Presence<br/><?= $character->presence ?>
            </div>
        </div>

        <div class="row">
            Soak: <?= $character->wounds ?><br/>
            Strain: <?= $character->strain ?>
        </div>

        <h3>Skills</h3>

        <div class="row">
            <?php foreach ($skills as $skill): ?>
                <div class="row">
                    <div class="col-md-4"><?= $skill->name ?> (<?= $skill->characteristic->code?>)</div>
                    <div class="col-md-1"><?= $skill->level ?></div>
                    <div class="col-md-7"><?= str_repeat($this->Html->image('dice-proficiency.png'), $skill->dice($character)[0]) ?><?= str_repeat($this->Html->image('dice-ability.png'), $skill->dice($character)[1]) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>