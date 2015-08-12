<?php $this->Html->addCrumb('Users', '/users'); ?>
<?php $this->Html->addCrumb($user->username); ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <?= $this->Form->create($user, ['class' => 'form-horizontal']) ?>

        <div class="form-group">
            <?= $this->Form->label('username', null, ['class' => 'col-sm-3 control-label']) ?>
            <div class="col-sm-9">
                <?= $this->Form->input('username', ['label' => false, 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) ?>
            </div>
        </div>
        <div class="form-group">
            <?= $this->Form->label('new_password', null, ['class' => 'col-sm-3 control-label']) ?>
            <div class="col-sm-9">
                <?= $this->Form->input('new_password', ['label' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) ?>
            </div>
        </div>
        <div class="form-group">
            <?= $this->Form->label('password_confirm', null, ['class' => 'col-sm-3 control-label']) ?>
            <div class="col-sm-9">
                <?= $this->Form->input('password_confirm', ['label' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) ?>
            </div>
        </div>
        <div class="form-group">
            <?= $this->Form->label('role', null, ['class' => 'col-sm-3 control-label']) ?>
            <div class="col-sm-9">
                <?= $this->Form->input('role', [
                    'label' => false,
                    'class' => 'form-control',
                    'options' => ['admin' => 'Admin', 'author' => 'Author']
                ]) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-default']); ?>
            </div>
        </div>

        <?= $this->Form->end(); ?>

    </div>
</div>
