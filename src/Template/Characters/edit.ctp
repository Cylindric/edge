<div class="row">
    <div class="col-md-4">
        <h3><?= __('Actions') ?></h3>
        <ul>
            <li><?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $character->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $character->id)]
                )
                ?></li>
            <li><?= $this->Html->link(__('List Characters'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('List Growth'), ['controller' => 'Growth', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Growth'), ['controller' => 'Growth', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Training'), ['controller' => 'Training', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Training'), ['controller' => 'Training', 'action' => 'add']) ?></li>
        </ul>
    </div>
    <div class="col-md-6">
        <?= $this->Form->create($character) ?>
        <fieldset>
            <legend><?= __('Edit Character') ?></legend>
            <?php
            echo $this->Form->input('name');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
