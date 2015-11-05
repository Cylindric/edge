<div class="row">
    <div class="col-md-4 col-md-offset-4">

        <?= $this->Form->create($newUser, ['class' => 'form']) ?>

        <div class="form-group">
            <?= $this->Form->input('email', ['label' => false, 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'name@example.com']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->input('username', ['label' => false, 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Username (optional)']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->input('password', ['label' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->input('confirm_password', ['label' => false, 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm Password']) ?>
        </div>
        <div class="form-group text-center">
            <?= $this->Form->button('Create New Account', ['class' => 'btn btn-info']); ?>
        </div>

        <?= $this->Form->end(); ?>

    </div>
</div>
