<?php
namespace App\Controller;

use App\Controller\AppController;

class SpecialisationsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

	public function export()
	{
		$this->set('data', ['specialisations' => $this->Specialisations->export()]);
		$this->set('_serialize', 'data');
	}
}
