<?php
namespace App\Controller;

class CharacterTalentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('CharactersTalents');
        $this->loadModel('Characters');
        $this->loadModel('Talents');
    }

    public function isAuthorized($user)
    {
        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
            'add',
            'edit',
            'change_rank',
            'delete'
        ])) {
            if ($this->request->is('post')) {
                if ($this->Characters->isOwnedBy($this->request->data['character_id'], $user['id'])) {
                    return true;
                }
            }
        }

        return parent::isAuthorized($user);
    }

    public function add()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {

            $character_id = $this->request->data['character_id'];
            $talent_id = $this->request->data['talent_id'];

            $link = $this->CharactersTalents->newEntity();
            $link->character_id = $character_id;
            $link->talent_id = $talent_id;
            $link->rank = 1;

            if ($this->CharactersTalents->save($link)) {
                $response = ['result' => 'success', 'data' => $link];
            }
        }
        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function edit($character_id)
    {
        $talents = $this->CharactersTalents
            ->find()
            ->contain(['Characters', 'Talents'])
            ->where(['character_id' => $character_id])
            ->order('Talents.name');

        $this->set('talents', $talents);
        $this->set('_serialize', ['character']);
    }

    public function change_rank()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $delta = (int)$this->request->data['delta'];
            $character_id = (int)$this->request->data['character_id'];
            $id = (int)$this->request->data['link_id'];

            $link = $this->CharactersTalents->find()
                ->contain(['Characters', 'Talents'])
                ->where(['CharactersTalents.character_id' => $character_id])
                ->andWhere(['CharactersTalents.id' => $id])
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

    public function delete()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $id = $this->request->data['id'];

            $link = $this->CharactersTalents->get($id);
            if ($this->CharactersTalents->delete($link)) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);

    }

}
