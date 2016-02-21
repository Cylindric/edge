<!DOCTYPE html>
<html lang="en" ng-app="rpgAppNg">
    <head>
        <?= $this->Html->charset() ?>
        <title>Edge: <?= $this->fetch('title') ?></title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('/node_modules/angular-material/angular-material.css') ?>

        <?= $this->Html->css('jquery-ui.css') ?>
        <?= $this->Html->css('bootstrap.css') ?>
        <?= $this->Html->css('bootstrap-editable.css') ?>

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
                            <li class="dropdown <?php if ($this->request->params['controller'] == 'Characters'): ?>active<?php endif; ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                   aria-expanded="false">Characters <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('List', '/characters/') ?></li>
                                    <li><?= $this->Html->link('New', '/characters/add') ?></li>
                                </ul>
                            </li>
                            <?php if ($user['role'] == 'admin'): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><?= $this->Html->link('List', '/users/') ?></li>
                                        <li><?= $this->Html->link('New', '/users/add') ?></li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">Groups <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('List', '/groups/') ?></li>
                                    <?php if ($user['role'] == 'admin'): ?>
                                        <li><?= $this->Html->link('New', '/groups/add') ?></li>
                                    <?php endif; ?>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php if ($user['role'] == 'admin'): ?>
                                        <li><?= $this->Html->link('Armour', '/armour') ?></li>
                                        <li><?= $this->Html->link('Careers', '/careers') ?></li>
                                        <li><?= $this->Html->link('Items', '/items') ?></li>
                                        <li><?= $this->Html->link('Item Types', '/item_types') ?></li>
                                        <li><?= $this->Html->link('Ranges', '/ranges') ?></li>
                                        <li><?= $this->Html->link('Skills', '/skills') ?></li>
                                        <li><?= $this->Html->link('Specialisations', '/specialisations') ?></li>
                                        <li><?= $this->Html->link('Species', '/species') ?></li>
                                        <li><?= $this->Html->link('Stats', '/stats') ?></li>
                                        <li><?= $this->Html->link('Talents', '/talents') ?></li>
                                        <li><?= $this->Html->link('Weapons', '/weapons') ?></li>
                                        <li><?= $this->Html->link('Weapon Types', '/weapon_types') ?></li>
                                        <li role="separator" class="divider"></li>
                                        <li><?= $this->Html->link('Sources', '/sources') ?></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <?php if (is_null($user)): ?>
                                <li><?= $this->Html->link('Login', '/users/login') ?></li>
                            <?php else: ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false"><?= $user['username'] ?> <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><?= $this->Html->link('Logout', '/users/logout') ?></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?= $this->Html->getCrumbList(['class' => 'breadcrumb hidden-print', 'lastclass' => 'active'], 'Home'); ?>

            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
            <div class="footer">Version: <?= $version; ?></div>
        </div>

        <?php
        echo $this->Html->script('jquery-2.1.4.js');
        echo $this->Html->script('jquery-ui.min.js');
        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->script('bootstrap-editable.min.js');

        echo $this->Html->script('/node_modules/angular/angular.min.js');
        echo $this->Html->script('/node_modules/angular-animate/angular-animate.min.js');
        echo $this->Html->script('/node_modules/angular-aria/angular-aria.min.js');
        echo $this->Html->script('/node_modules/angular-messages/angular-messages.min.js');
        echo $this->Html->script('/node_modules/angular-material/angular-material.min.js');
        echo $this->Html->script('/node_modules/angular-marked/node_modules/marked/lib/marked.js');
        echo $this->Html->script('/node_modules/angular-marked/dist/angular-marked.min.js');
        echo $this->Html->script('ui-bootstrap-tpls-1.1.2.min.js');

        $scripts = [
            'rpgApp.js',
            'services/armour_service.js',
            'services/credit_service.js',
            'services/item_service.js',
            'services/obligation_service.js',
            'services/talent_service.js',
            'services/weapon_service.js',
            'services/xp_service.js',
            'controllers/character_edit_controller.js',
            'controllers/character_index_controller.js',
            'controllers/group_edit_controller.js',
        ];

        if ($debug > 0) {
            foreach ($scripts as $script) {
                echo $this->Html->script($script);
            }
        } else {
            echo $this->Html->script('/min/b=js&f=' . join(',', $scripts));
        }

        echo $this->fetch('script')
        ?>
    </body>
</html>
