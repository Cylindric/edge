<?php
$this->Html->addCrumb('Characters', '/characters');
$this->Html->addCrumb($character->name);
?>


<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <?= $this->Form->create($character, ['class' => 'form-horizontal']) ?>

        <div class="form-group">
            <?= $this->Form->label('Group', null, ['class' => 'col-sm-3 control-label']) ?>
            <div class="col-sm-7">
                <?= $this->Form->input('group_id', ['options' => $groups, 'label' => false]); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= $this->Form->button('Join', ['class' => 'btn']); ?>
            </div>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>
