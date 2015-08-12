<div class="row">
    <div class="col-md-6 col-md-offset-3">

    <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>

        <div class="form-group">
            <?= $this->Form->label('username', null, ['class' => 'col-sm-2 control-label']) ?>
            <div class="col-sm-10">
                <?= $this->Form->input('username', ['label' => false]) ?>
            </div>
        </div>
        <div class="form-group">
            <?= $this->Form->label('password', null, ['class' => 'col-sm-2 control-label']) ?>
            <div class="col-sm-10">
                <?= $this->Form->input('password', ['label' => false]) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= $this->Form->button('Login', ['class' => 'btn']); ?>
            </div>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>