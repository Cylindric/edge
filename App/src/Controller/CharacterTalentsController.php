<?php

namespace App\Controller;

class CharacterTalentsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('CharactersTalents');
        $this->loadModel('Characters');
        $this->loadModel('Talents');
    }

    public function isAuthorized($user) {
        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
                    'add',
                    'edit',
                    'change_rank',
                    'delete'
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
            $talent_id = $this->request->data['talent_id'];

            $link = $this->CharactersTalents->find()
                    ->contain(['Characters', 'Talents'])
                    ->where(['CharactersTalents.character_id' => $character_id])
                    ->andWhere(['CharactersTalents.talent_id' => $talent_id]);

            if ($link->count() == 0) {
                $link = $this->CharactersTalents->newEntity();
                $link->character_id = $character_id;
                $link->talent_id = $talent_id;
                $link->rank = 1;

                if ($this->CharactersTalents->save($link)) {
                    $response = ['result' => 'success', 'data' => $link];
                }
            } else {
                $response = ['result' => 'success', 'data' => $link->first()];                
            }
        }
        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function edit($character_id) {
        $talents = $this->CharactersTalents
                ->find()
                ->contain(['Characters', 'Talents'])
                ->where(['character_id' => $character_id])
                ->order('Talents.name');

        $this->set('talents', $talents);
        $this->set('_serialize', ['talents']);
    }

    public function change_rank() {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $delta = (int) $this->request->data['delta'];
            $character_id = (int) $this->request->data['character_id'];
            $talent_id = (int) $this->request->data['talent_id'];

            $link = $this->CharactersTalents->find()
                    ->contain(['Characters', 'Talents'])
                    ->where(['CharactersTalents.character_id' => $character_id])
                    ->andWhere(['CharactersTalents.talent_id' => $talent_id])
                    ->first();

            if ($link->talent->ranked) {
                $link->rank += $delta;
                if ($link->rank < 1) {
                    $link->rank = 1;
                }
            }
            if ($this->CharactersTalents->save($link)) {
                // Announce
                $this->Slack->announceCharacterEdit($link->character);
                $response = ['result' => 'success', 'data' => $link->rank];
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function delete() {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $character_id = (int) $this->request->data['character_id'];
            $talent_id = (int) $this->request->data['talent_id'];

            $link = $this->CharactersTalents->find()
                    ->where(['CharactersTalents.character_id' => $character_id])
                    ->andWhere(['CharactersTalents.talent_id' => $talent_id])
                    ->first();

            if ($this->CharactersTalents->delete($link)) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

}
