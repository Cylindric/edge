<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ImportForm;

class InstallController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		//$this->loadModel('Characters');
	}

	public function isAuthorized($user)
	{
		if ($this->request->action === 'import') {
			return true;
		}

		return parent::isAuthorized($user);
	}

	public function import()
	{
		$import = new ImportForm();
		if ($this->request->is('post')) {
			if ($import->execute($this->request->data)) {

			} else {
				$this->Flash->error('There was a problem submitting your form.');
			}
		}
		$this->set('import', $import);
	}

}
