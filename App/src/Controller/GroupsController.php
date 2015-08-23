<?php
namespace App\Controller;

use App\Controller\AppController;

class GroupsController extends AppController
{

    public function index()
    {
        $this->set('groups', $this->paginate($this->Groups));
        $this->set('_serialize', ['groups']);
    }

    public function view($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => [
                'Characters',
                'Characters.Species',
                'Characters.Careers',
                'Characters.Specialisations',
            ]
        ]);
        $this->set('group', $group);
        $this->set('_serialize', ['group']);
    }

    public function add()
    {
        $group = $this->Groups->newEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Groups->Characters->find('list', ['limit' => 200]);
        $this->set(compact('group', 'characters'));
        $this->set('_serialize', ['group']);
    }

    public function edit($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => [
                'Characters' => ['sort' => 'Characters.name'],
                'Characters.Species',
                'Characters.Careers',
                'Characters.Obligations',
                'Characters.Specialisations',
                'Characters.Users',
            ],
        ]);

        $this->loadModel('Weapons');
        $weapons = $this->Weapons->find();
        $weapons
            ->contain(['Ranges'])
            ->matching('CharactersWeapons.Characters', function ($q) use ($id) {
                return $q->where(['Characters.group_id' => $id]);
            })
            ->where(['CharactersWeapons.equipped' => true])
            ->order(['Characters.name'])
        ;

        $this->loadModel('Obligations');
        $obligations = $this->Obligations->find();
        $obligations
            ->contain(['Characters'])
            ->select([
                'type',
                'value' => $obligations->func()->sum('value')
            ])
            ->where(['Characters.group_id' => $id])
            ->group('type')
            ->order('value DESC')
            ;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('group', 'obligations', 'weapons'));
        $this->set('_serialize', ['group']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
