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

    public function drop($char_id, $link_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($link_id)) {
            $this->loadModel('CharactersArmour');

            if ($this->CharactersArmour->delete($this->CharactersArmour->get($link_id))) {
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

    public function toggle($char_id = null, $link_id = null)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($link_id)) {
            $Char = $this->Characters->get($char_id, [
                'contain' => ['CharactersArmour' => ['conditions' => ['CharactersArmour.id' => $link_id]]]]);

            if (count($Char->characters_armour) == 0) {
                // Non-existent link, invalid operation
            } else {
                $t = $Char->characters_armour[0];
                $t->equipped = !$t->equipped;

                $Char->dirty('characters_armour', true);
                if ($this->Characters->save($Char)) {
                    $response = ['result' => 'success', 'data' => $t->equipped];
                }
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }


}