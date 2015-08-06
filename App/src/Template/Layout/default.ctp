<!DOCTYPE html>
<html lang="en">
<head>
	<?= $this->Html->charset() ?>
	<title>Edge: <?= $this->fetch('title') ?></title>
	<?= $this->Html->meta('icon') ?>

	<?= $this->Html->script('jquery.min.js') ?>
	<?= $this->Html->script('jquery-ui.min.js') ?>
	<?= $this->Html->script('bootstrap.min.js') ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?= $this->Html->css('http://fonts.googleapis.com/css?family=Anton|Nunito') ?>
	<?= $this->Html->css('bootstrap.css') ?>
	<?= $this->Html->css('bootstrap-theme.css') ?>
	<?= $this->Html->css('edge.css') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
</head>
<body>
<div class="container">

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
				<a class="navbar-brand" href="/">EdgeXX</a>
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

	<?= $this->Flash->render() ?>
	<?= $this->fetch('content') ?>
</div>
<?= $this->fetch('script') ?>
</body>
</html>
