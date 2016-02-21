<?php

namespace App\Controller;

class GroupsController extends AppController {

    public function isAuthorized($user) {
        if (in_array($this->request->action, ['index'])) {
            return true;
        }

        // Groups are editable by the GM only
        if (in_array($this->request->action, [
                    'edit',
                ])) {
            $groupId = (int) $this->request->params['pass'][0];
            if ($this->Groups->isOwnedBy($groupId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $user_id = $this->Auth->User('id');

        $groups = $this->Groups->find();
        $groups->select(['Groups.id', 'Groups.name']);
        if ($this->Auth->user('role') == 'admin') {
            $groups
                    ->matching('GroupsUsers');
        } else {
            $groups
                    ->matching('GroupsUsers', function ($q) use ($user_id) {
                        return $q->where(['GroupsUsers.user_id' => $user_id]);
                    });
        }
        $groups->distinct();
        $this->set('groups', $this->paginate($groups));
        $this->set('_serialize', ['groups']);
    }

    public function view($id = null) {
        $group = $this->Groups->get($id, [
            'contain' => [
                'Characters',
                'Characters.Users',
                'Characters.Species',
                'Characters.Careers',
                'Characters.Specialisations',
            ]
        ]);
        $this->set('group', $group);
        $this->set('_serialize', ['group']);
    }

    public function add() {
        $group = $this->Groups->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['groups_users'] = [
                ['user_id' => $this->Auth->User('id'), 'gm' => true]
            ];

            $group = $this->Groups->newEntity($data, ['associated' => ['GroupsUsers']]);

            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }
        $characters = $this->Groups->CharactersGroups->Characters->find('list');
        $this->set(compact('group', 'characters'));
        $this->set('_serialize', ['group']);
    }

    public function edit($id = null) {
        $group = $this->Groups->get($id, [
            'contain' => [
                'CharactersGroups',
                'CharactersGroups.Characters' => ['sort' => 'Characters.name'],
                'CharactersGroups.Characters.Species',
                'CharactersGroups.Characters.Careers',
                'CharactersGroups.Characters.Obligations',
                'CharactersGroups.Characters.Specialisations',
                'CharactersGroups.Characters.Users',
            ],
        ]);

        $this->loadModel('Weapons');
        $weapons = $this->Weapons->find();
        $weapons
                ->contain(['Ranges', 'Skills', 'Skills.Stats', 'CharactersWeapons.Characters'])
                ->matching('CharactersWeapons.Characters.CharactersGroups', function ($q) use ($id) {
                    return $q->where(['CharactersGroups.group_id' => $id]);
                })
                ->where(['CharactersWeapons.equipped' => true])
                ->order(['Characters.name']);

        $this->loadModel('Obligations');
        $obligations = $this->Obligations->find();
        $obligations
                ->contain(['Characters', 'Characters.CharactersGroups'])
                ->matching('Characters.CharactersGroups', function ($q) use ($id) {
                    return $q->where(['CharactersGroups.group_id' => $id]);
                })
                ->select([
                    'type',
                    'value' => $obligations->func()->sum('value')
                ])
                ->group('type')
                ->order('value DESC');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }

        // For ajax requests, populate some data
        // Set some character details
        foreach ($group->characters_groups as $cg) {
            $cg->character->total_xp = $cg->character->total_xp;
        }

        // Set some dice details
        foreach ($weapons as $weapon) {
            $weapon->dice_details = $weapon->skill->dice($weapon->characters_weapons[0]->character);
        }



        $this->set(compact('group', 'obligations', 'weapons'));
        $this->set('_serialize', ['group', 'obligations', 'weapons']);
    }

    public function delete($id = null) {
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
