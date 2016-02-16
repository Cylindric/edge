<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Talents Controller
 *
 * @property \App\Model\Table\SourcesTable $Sources
 */
class SourcesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

	public function isAuthorized($user)
	{
		if ($this->request->action === 'index') {
			return true;
		}

		return parent::isAuthorized($user);
	}

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index()
	{
		if ($this->request->is('json')) {
			$sources = $this->Sources->find();
		} else {
			$sources = $this->paginate($this->Sources->find());
		}
		$this->set('sources', $sources);
		$this->set('_serialize', ['sources']);
	}

}
