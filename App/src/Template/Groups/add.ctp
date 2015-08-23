<?php $this->Html->addCrumb('Groups', '/Groups'); ?>
<?php $this->Html->addCrumb('New'); ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <?= $this->Form->create($group, ['class' => 'form-horizontal']) ?>

        <div class="form-group">
            <?= $this->Form->label('name', null, ['class' => 'col-sm-2 control-label']) ?>
            <div class="col-sm-10">
                <?= $this->Form->input('name', ['label' => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Name']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-default']); ?>
            </div>
        </div>

        <?= $this->Form->end(); ?>

    </div>
</div>
