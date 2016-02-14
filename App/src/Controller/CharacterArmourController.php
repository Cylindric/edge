<?php

namespace App\Controller;

class CharacterArmourController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Characters');
        $this->loadModel('Armour');
        $this->loadModel('CharactersArmour');
    }

    public function isAuthorized($user) {
        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
                    'add',
                    'delete',
                    'edit',
                    'toggle',
                ])) {
            if ($this->request->is('post')) {
                $character_id = $this->request->data['character_id'];
            } else {
                $character_id = (int) $this->request->params['pass'][0];
            }
            if ($this->Characters->isOwnedBy($character_id, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function add($char_id, $armour_id) {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($armour_id)) {

            $Char = $this->Characters->get($char_id, [
                'contain' => ['Armour']
            ]);

            $this->loadModel('Armour');
            $W = $this->Armour->get($armour_id);

            if ($this->Characters->Armour->link($Char, [$W])) {
                // Announce
                $this->Slack->announceCharacterEdit($Char);
                $response = ['result' => 'success', 'data' => $Char->armour];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function delete() {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $id = (int) $this->request->data['id'];

            $link = $this->CharactersArmour->get($id);
            if ($this->CharactersArmour->delete($link)) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    public function edit($character_id) {
        $data = $this->CharactersArmour
                ->find('all')
                ->contain(['Characters', 'Armour'])
                ->where(['character_id' => $character_id]);

        $this->set('character_armour', $data);
        $this->set('_serialize', 'character_armour');
    }

    public function set_equipped() {
        $response = null;

        if ($this->request->is('post')) {
            $id = (int) $this->request->data['id'];
            $equipped = (bool) $this->request->data['equipped'];

            $link = $this->CharactersArmour->find()
                    ->where(['id' => $id])
                    ->first();

            $link->equipped = $equipped;

            if ($this->CharactersArmour->save($link)) {
                $response = $link;
            } else {
                $this->response->statusCode(400);
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', 'response');
    }

}
