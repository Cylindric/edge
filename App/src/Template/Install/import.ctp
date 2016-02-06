<?= $this->Flash->render('success'); ?>
<?= $this->Form->create($import, [ 'class' => 'form-horizontal']) ?>
<?= $this->Form->input('name');?>
<?= $this->Form->input('email');?>
<?= $this->Form->input('body');?>
<?= $this->Form->button('Submit');?>
<?= $this->Form->end() ?>
