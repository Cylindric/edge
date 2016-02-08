<?php
namespace App\Controller;

use App\Controller\AppController;

class CareersController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

	public function export()
	{
		$this->set('data', ['careers' => $this->Careers->export()]);
		$this->set('_serialize', 'data');
	}
}
