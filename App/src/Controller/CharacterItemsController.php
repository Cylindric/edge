<?php

namespace App\Controller;

class CharacterItemsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('Characters');
        $this->loadModel('Items');
        $this->loadModel('CharactersItems');
    }

    public function isAuthorized($user) {
        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
                    'add',
                    'delete',
                    'edit',
                    'toggle_carry',
                    'toggle_equip',
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

    public function add() {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {

            $character_id = $this->request->data['character_id'];
            $item_id = $this->request->data['item_id'];

            $link = $this->CharactersItems->newEntity();
            $link->character_id = $character_id;
            $link->item_id = $item_id;
            $link->quantity = 1;

            if ($this->CharactersItems->save($link)) {
                $data = $this->CharactersItems->findById($link->id)->contain(['Items'])->first();
                $response = ['result' => 'success', 'data' => $data];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    public function delete() {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $id = $this->request->data['id'];

            $link = $this->CharactersItems->get($id);
            if ($this->CharactersItems->delete($link)) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function edit($character_id) {
        $data = $this->CharactersItems
                ->find('all')
                ->contain([
                    'Characters',
                    'Items',
                ])
                ->where(['character_id' => $character_id]);

        $this->set('character_items', $data);
        $this->set('_serialize', 'character_items');
    }

    public function toggle_carry() {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $character_id = (int) $this->request->data['character_id'];
            $id = (int) $this->request->data['link_id'];

            $link = $this->CharactersItems->find()
                    ->contain(['Characters', 'Items'])
                    ->where(['CharactersItems.character_id' => $character_id])
                    ->andWhere(['CharactersItems.id' => $id])
                    ->first();

            $link->carried = !$link->carried;

            // If the item isn't carried, it can't be equipped either
            if ($link->carried == false) {
                $link->equipped = false;
            }

            if ($this->CharactersItems->save($link)) {
                $response = ['result' => 'success', 'data' => $link];
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function toggle_equip() {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $character_id = (int) $this->request->data['character_id'];
            $id = (int) $this->request->data['link_id'];

            $link = $this->CharactersItems->find()
                    ->contain(['Characters', 'Items'])
                    ->where(['CharactersItems.character_id' => $character_id])
                    ->andWhere(['CharactersItems.id' => $id])
                    ->first();

            $link->equipped = !$link->equipped;

            // If the item is equipped, it must be carried too
            if ($link->equipped == true) {
                $link->carried = true;
            }

            if ($this->CharactersItems->save($link)) {
                $response = ['result' => 'success', 'data' => $link];
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

}
