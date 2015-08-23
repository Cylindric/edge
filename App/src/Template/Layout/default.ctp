<!DOCTYPE html>
<html lang="en">
<head>
	<?= $this->Html->charset() ?>
	<title>Edge: <?= $this->fetch('title') ?></title>
	<?= $this->Html->meta('icon') ?>

	<?= $this->Html->css('jquery-ui.css') ?>
	<?= $this->Html->css('bootstrap.css') ?>
	<?= $this->Html->css('bootstrap-editable.css') ?>
	<?= $this->Html->script('jquery-2.1.4.js') ?>
	<?= $this->Html->script('jquery-ui.min.js') ?>
	<?= $this->Html->script('bootstrap.min.js') ?>
	<?= $this->Html->script('bootstrap-editable.min.js') ?>
	<?= $this->Html->script('rpgApp.js') ?>

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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Characters <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><?= $this->Html->link('List', '/characters/') ?></li>
							<li><?= $this->Html->link('New', '/characters/add') ?></li>
						</ul>
					</li>
					<?php if ($user['role'] == 'admin'): ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><?= $this->Html->link('List', '/users/') ?></li>
								<li><?= $this->Html->link('New', '/users/add') ?></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Groups <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><?= $this->Html->link('List', '/groups/') ?></li>
								<li><?= $this->Html->link('New', '/groups/add') ?></li>
							</ul>
						</li>
					<?php endif; ?>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php if (is_null($user)): ?>
						<li><?= $this->Html->link('Login', '/users/login') ?></li>
					<?php else: ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $user['username'] ?> <span class="caret"></span></a>
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
</div>
<?= $this->fetch('script') ?>
</body>
</html>
