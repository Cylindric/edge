<?php
namespace App\Controller;

use App\Controller\AppController;


class InstallController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadModel('Characters');
	}

	public function isAuthorized($user)
	{
		return parent::isAuthorized($user);
	}

	public function sample()
	{
		$character = $this->Characters->newEntity();

		$char = [
			'name' => 'Test Character',
		];
	}

}
