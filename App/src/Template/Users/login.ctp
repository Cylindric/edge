<div class="row">
	<div class="col-md-12">
		<?= $this->Flash->render('auth') ?>
		<?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
			
			<div class="control-group">
				<?= $this->Form->label('username', null, ['class' => 'control-label']) ?>
				<div class="controls">
					<?= $this->Form->input('username', ['label' => false]) ?>
				</div>
			</div>
			<div class="control-group">
				<?= $this->Form->label('password', null, ['class' => 'control-label']) ?>
				<div class="controls">
					<?= $this->Form->input('password', ['label' => false]) ?>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<?= $this->Form->button('Login', ['class' => 'btn']); ?>
				</div>
			</div>

		<?= $this->Form->end() ?>
	</div>
</div>