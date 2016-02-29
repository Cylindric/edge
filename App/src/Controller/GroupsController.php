<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

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

        // Get the Groups the current User has a Character in
        $chars = $this->Groups
                ->CharactersGroups
                ->find()
                ->contain('Characters')
                ->where(['Characters.user_id' => $user_id])
                ->select(['group_id']);

        // Get the groups the current User is a GM for
        $gms = $this->Groups
                ->GroupsUsers
                ->find()
                ->where(['user_id' => $user_id])
                ->select(['group_id']);

        // Get the Groups the current User should see
        $groups = $this->Groups
                ->find()
                ->select(['Groups.id', 'Groups.name']);

        // Non-admins can only see their own groups, so apply the above filters
        if ($this->Auth->user('role') !== 'admin') {
            $groups->where(['Groups.id IN' => $chars])
                    ->orWhere(['Groups.id IN' => $gms])
            ;
        }

        $groups->distinct();

        if ($this->request->is('json')) {
            $data = $groups->toArray();
            foreach ($data as $group) {
                $group->PreSerialise($user_id);
            }
            $this->set('groups', $data);
            $this->set('_serialize', ['groups']);
        } else {
            $this->set('groups', $this->paginate($groups));
            $this->set('_serialize', ['groups']);
        }
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

    public function view($id = null) {

        if (!$this->request->is('json')) {
            $group = $this->Groups->get($id);
            $this->set(compact('group'));
            return;
        }

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

        // Get the weapons used by characters in the group
        $this->loadModel('Weapons');
        $weapons = $this->Weapons->find();
        $weapons
                ->contain(['Ranges', 'Skills', 'Skills.Stats', 'CharactersWeapons.Characters'])
                ->matching('CharactersWeapons.Characters.CharactersGroups', function ($q) use ($id) {
                    return $q->where(['CharactersGroups.group_id' => $id]);
                })
                ->where(['CharactersWeapons.equipped' => true])
                ->order(['Characters.name']);
//dump($weapons);
        // Get the obligation of characters in the group
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

//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $group = $this->Groups->patchEntity($group, $this->request->data);
//            if ($this->Groups->save($group)) {
//                $this->Flash->success(__('The group has been saved.'));
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error(__('The group could not be saved. Please, try again.'));
//            }
//        }

        // Save some data to the object that would get lost on serialisation
        if ($this->request->is('json')) {
            $group->PreSerialise($this->CurrentUser);

            foreach ($group->characters_groups as $cg) {
                $cg->character->is_editable = $cg->character->IsEditableByUser($this->CurrentUser);
            }

            foreach ($weapons as $weapon) {
               $weapon->dice_details = $weapon->skill->dice($weapon->characters_weapons[0]->character);
            }
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
