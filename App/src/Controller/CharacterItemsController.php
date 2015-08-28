<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Rpg\CalculatorFactory;
use Cake\Utility\Inflector;

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
            'drop',
            'edit',

        ])) {
            $characterId = (int)$this->request->params['pass'][0];
            if ($this->Characters->isOwnedBy($characterId, $user['id'])) {
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

    public function drop($char_id, $link_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($link_id)) {
            $this->loadModel('CharactersItems');

            if ($this->CharactersItems->delete($this->CharactersItems->get($link_id))) {
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

    public function toggle($char_id = null, $link_id = null)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($link_id)) {
            $Char = $this->Characters->get($char_id, [
                'contain' => ['CharactersItems' => ['conditions' => ['CharactersItems.id' => $link_id]]]]);

            if (count($Char->characters_item) == 0) {
                // Non-existent link, invalid operation
            } else {
                $t = $Char->characters_item[0];
                $t->equipped = !$t->equipped;

                $Char->dirty('characters_item', true);
                if ($this->Characters->save($Char)) {
                    $response = ['result' => 'success', 'data' => $t->equipped];
                }
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }


}