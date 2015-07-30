<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>Edge: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js') ?>
    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>

    <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') ?>
    <?= $this->Html->css('http://fonts.googleapis.com/css?family=Anton') ?>
    <?= $this->Html->css('http://fonts.googleapis.com/css?family=Nunito') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('bootstrap-theme.css') ?>
    <?= $this->Html->css('edge.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <div class="container-fluid">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <?= $this->fetch('script') ?>
</body>
</html>
