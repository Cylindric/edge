<div class="row">
    <div class="col-md-4 col-md-offset-4">

        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create(null, ['class' => 'form']) ?>

        <div class="form-group">
            <?= $this->Form->input('email', ['label' => false, 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'name@example.com']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->input('password', ['label' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) ?>
        </div>
        <div class="form-group text-center">
            <div class="checkbox">
                <label><?= $this->Form->checkbox('remember_me', ['label' => false]) ?>Remember me?</label>
            </div>
        </div>
        <div class="form-group">
            <?= $this->Form->button('Login', ['class' => 'btn']) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>