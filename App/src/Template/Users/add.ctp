<?php $this->Html->addCrumb('Users', '/users'); ?>
<?php $this->Html->addCrumb('New'); ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <?= $this->Form->create($newUser, ['class' => 'form-horizontal']) ?>

        <div class="form-group">
            <?= $this->Form->label('username', null, ['class' => 'col-sm-2 control-label']) ?>
            <div class="col-sm-10">
                <?= $this->Form->input('username', ['label' => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Username']) ?>
            </div>
        </div>
        <div class="form-group">
            <?= $this->Form->label('password', null, ['class' => 'col-sm-2 control-label']) ?>
            <div class="col-sm-10">
                <?= $this->Form->input('password', ['label' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) ?>
            </div>
        </div>
        <div class="form-group">
            <?= $this->Form->label('role', null, ['class' => 'col-sm-2 control-label']) ?>
            <div class="col-sm-10">
                <?= $this->Form->input('role', [
                    'label' => false,
                    'class' => 'form-control',
                    'options' => ['admin' => 'Admin', 'author' => 'Author']
                ]) ?>
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
