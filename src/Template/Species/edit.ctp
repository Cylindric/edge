<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $species->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $species->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Species'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="species form large-10 medium-9 columns">
    <?= $this->Form->create($species) ?>
    <fieldset>
        <legend><?= __('Edit Species') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
