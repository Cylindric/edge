<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Rpg\CalculatorFactory;
use Cake\Utility\Inflector;

class CharacterArmourController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Characters');
        $this->loadModel('Armour');
        $this->loadModel('CharactersArmour');
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

    public function add($char_id, $armour_id)
    {
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

    public function delete()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $id = $this->request->data['id'];

            $link = $this->CharactersArmour->get($id);
            if ($this->CharactersArmour->delete($link)) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function edit($char_id)
    {
        $character = $this->Characters->get($char_id, ['contain' => ['CharactersArmour', 'CharactersArmour.Armour']]);

        $this->set('character', $character);
    }

    public function toggle()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $character_id = (int)$this->request->data['character_id'];
            $id = (int)$this->request->data['link_id'];

            $link = $this->CharactersArmour->find()
                ->contain(['Characters', 'Armour'])
                ->where(['CharactersArmour.character_id' => $character_id])
                ->andWhere(['CharactersArmour.id' => $id])
                ->first();

            $link->equipped = !$link->equipped;

            if ($this->CharactersArmour->save($link)) {
                $response = ['result' => 'success', 'data' => $link->equipped];
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }


}