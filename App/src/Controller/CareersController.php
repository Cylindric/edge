<?php
namespace App\Controller;

class CareersController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

	public function index()
	{
		$careers = $this->paginate($this->Careers);
		$this->set('careers', $careers);
		$this->set('_serialize', 'careers');
	}

	public function view($id)
	{
		$career = $this->Careers->get($id, [
			'contain' => ['Sources']
		]);
		$this->set('career', $career);
		$this->set('_serialize', ['career']);
	}

	public function add()
	{
		$career = $this->Careers->newEntity(['source_id' => 1]);
		if ($this->request->is('post')) {
			$career = $this->Careers->patchEntity($career, $this->request->data);
			if ($this->Careers->save($career)) {
				$this->Flash->success(__('The career has been saved.'));
				return $this->redirect(['action' => 'view', $career->id]);
			} else {
				$this->Flash->error(__('The career could not be saved. Please, try again.'));
			}
		}
		$sources = $this->Careers->Sources->find('list')->toArray();
		$this->set(compact('career', 'sources'));
		$this->set('_serialize', ['career']);
	}

	public function edit($id)
	{
		$career = $this->Careers->get($id, [
			'contain' => ['Sources']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$career = $this->Careers->patchEntity($career, $this->request->data);
			if ($this->Careers->save($career)) {
				$this->Flash->success(__('The career has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The career could not be saved. Please, try again.'));
			}
		}

		$sources = $this->Careers->Sources->find('list')->toArray();
		$this->set(compact('career', 'sources'));
		$this->set('_serialize', ['career']);
	}

	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$career = $this->Careers->get($id);
		if ($this->Careers->delete($career)) {
			$this->Flash->success(__('The career has been deleted.'));
		} else {
			$this->Flash->error(__('The career could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function export()
	{
		$this->set('data', ['careers' => $this->Careers->export()]);
		$this->set('_serialize', 'data');
	}
}
