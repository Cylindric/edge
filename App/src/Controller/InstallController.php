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
			$this->Flash->success('before');
			if ($import->execute($this->request->data)) {
				$this->Flash->success('We will get back to you soon.');
			} else {
				$this->Flash->error('There was a problem submitting your form.');
			}
		}
		$this->set('import', $import);
	}

}
