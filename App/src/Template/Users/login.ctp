<?php
echo $this->Flash->render('auth');
echo $this->Form->create();
echo $this->Form->input(
    'provider',
    ['value' => 'Google']
);
echo $this->Form->input(
    'openid_identifier',
    ['value' => 'https://www.google.com/accounts/o8/id']
);
echo $this->Form->submit('Login');
echo $this->Form->end();
?>