<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>Edge: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('bootstrap-theme.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>
