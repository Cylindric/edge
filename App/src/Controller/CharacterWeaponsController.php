<?php
namespace App\Controller;

class CharacterWeaponsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('CharactersWeapons');
        $this->loadModel('Characters');
        $this->loadModel('Weapons');
    }

    public function isAuthorized($user)
    {
        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
            'add',
            'edit',
            'change_qty',
            'toggle',
            'delete',
        ])) {
            if ($this->request->is('post')) {
                $character_id = $this->request->data['character_id'];
            } else {
                $character_id = (int)$this->request->params['pass'][0];
            }
            if ($this->Characters->isOwnedBy($character_id, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function add()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {

            $character_id = $this->request->data['character_id'];
            $weapon_id = $this->request->data['weapon_id'];

            $link = $this->CharactersWeapons->newEntity();
            $link->character_id = $character_id;
            $link->weapon_id = $weapon_id;
            $link->quantity = 1;

            if ($this->CharactersWeapons->save($link)) {
                $response = ['result' => 'success', 'data' => $link];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function edit($character_id)
    {
        $character = $this->Characters->get($character_id, [
            'contain' => [
                'CharactersWeapons',
                'CharactersWeapons.Weapons',
                'CharactersWeapons.Weapons.Skills',
                'CharactersWeapons.Weapons.Ranges',
            ]]);

        $this->set('character', $character);
    }

    public function change_qty()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $delta = (int)$this->request->data['delta'];
            $character_id = (int)$this->request->data['character_id'];
            $id = (int)$this->request->data['link_id'];

            $link = $this->CharactersWeapons->find()
                ->contain(['Characters', 'Weapons'])
                ->where(['CharactersWeapons.character_id' => $character_id])
                ->andWhere(['CharactersWeapons.id' => $id])
                ->first();

            $link->quantity += $delta;
            if ($link->quantity < 1) {
                if ($this->CharactersWeapons->delete($link)) {
                    $response = ['result' => 'success', 'data' => 0];
                }
            } else {
                if ($this->CharactersWeapons->save($link)) {
                    $response = ['result' => 'success', 'data' => $link->quantity];
                }
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function toggle()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $character_id = (int)$this->request->data['character_id'];
            $id = (int)$this->request->data['link_id'];

            $link = $this->CharactersWeapons->find()
                ->contain(['Characters', 'Weapons'])
                ->where(['CharactersWeapons.character_id' => $character_id])
                ->andWhere(['CharactersWeapons.id' => $id])
                ->first();

            $link->equipped = !$link->equipped;

            if ($this->CharactersWeapons->save($link)) {
                $response = ['result' => 'success', 'data' => $link->equipped];
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function delete()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $id = $this->request->data['id'];

            $link = $this->CharactersWeapons->get($id);
            if ($this->CharactersWeapons->delete($link)) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

}