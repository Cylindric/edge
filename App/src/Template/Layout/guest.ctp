<!DOCTYPE html>
<html lang="en" ng-app="rpgAppNg">
<head>
    <?= $this->Html->charset() ?>
    <title>Edge: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <?php if( $debug>0): ?>
        <?= $this->Html->script('angular.min.js') ?>
        <?= $this->Html->script('angular-route.min.js') ?>
    <?php else: ?>
        <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js') ?>
        <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-route.min.js') ?>
    <?php endif; ?>

    <?= $this->Html->css('jquery-ui.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('bootstrap-editable.css') ?>
    <?= $this->Html->script('jquery-2.1.4.js') ?>
    <?= $this->Html->script('jquery-ui.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('bootstrap-editable.min.js') ?>

    <?= $this->Html->script('rpgApp.js') ?>
    <?= $this->Html->script('rpgControllers.js') ?>


    <!--
    <link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.css" rel="stylesheet"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.css" rel="stylesheet"/>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
    -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= $this->Html->css('http://fonts.googleapis.com/css?family=Anton|Nunito') ?>
    <?= $this->Html->css('edge.css') ?>
    <?= $this->Html->css('edge-print.css', ['media' => 'print']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
<div class="container-fluid">

    <div class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="/"
                        aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Edge</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><?= $this->Html->link('Register', '/users/register') ?></li>
                    <li><?= $this->Html->link('Login', '/users/login') ?></li>
                </ul>
            </div>
        </div>
    </div>

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
<?= $this->fetch('script') ?>
</body>
</html>
