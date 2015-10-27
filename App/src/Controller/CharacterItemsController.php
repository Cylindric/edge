<?php
namespace App\Controller;

class CharacterItemsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Characters');
        $this->loadModel('Items');
        $this->loadModel('CharactersItems');
    }

    public function isAuthorized($user)
    {
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
                $character_id = (int)$this->request->params['pass'][0];
            }
            if ($this->Characters->isOwnedBy($character_id, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function add($char_id, $item_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($item_id)) {

            $Char = $this->Characters->get($char_id, [
                'contain' => ['Items']
            ]);

            $this->loadModel('Items');
            $W = $this->Items->get($item_id);

            if ($this->Characters->Items->link($Char, [$W])) {
                // Announce
                $this->Slack->announceCharacterEdit($Char);
                $response = ['result' => 'success', 'data' => $Char->item];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function delete()
    {
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

    public function edit($char_id)
    {
        $character = $this->Characters->get($char_id, ['contain' => ['CharactersItems', 'CharactersItems.Items']]);

        $this->set('character', $character);
    }

    public function toggle()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $character_id = (int)$this->request->data['character_id'];
            $id = (int)$this->request->data['link_id'];

            $link = $this->CharactersItems->find()
                ->contain(['Characters', 'Items'])
                ->where(['CharactersItems.character_id' => $character_id])
                ->andWhere(['CharactersItems.id' => $id])
                ->first();

            $link->equipped = !$link->equipped;

            if ($this->CharactersItems->save($link)) {
                $response = ['result' => 'success', 'data' => $link->equipped];
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }


}