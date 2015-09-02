<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Rpg\CalculatorFactory;
use Cake\Utility\Inflector;

class CharacterWeaponsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Characters');
        $this->loadModel('Weapons');
    }

    public function isAuthorized($user)
    {
        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
            'add',
            'drop',
            'edit',
            'change_qty',
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
                'contain' => ['Weapons']
            ]);

            $this->loadModel('Weapons');
            $W = $this->Weapons->get($item_id);

            if ($this->Characters->Weapons->link($Char, [$W])) {
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
            $this->loadModel('CharactersWeapons');

            if ($this->CharactersWeapons->delete($this->CharactersWeapons->get($link_id))) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function edit($char_id)
    {
        $character = $this->Characters->get($char_id, [
            'contain' => [
                'CharactersWeapons',
                'CharactersWeapons.Weapons',
                'CharactersWeapons.Weapons.Skills',
                'CharactersWeapons.Weapons.Ranges',
            ]]);

        $this->set('character', $character);
    }

    public function change_qty($char_id = null, $join_id = null, $delta = 1)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($join_id)) {
            $delta = (int)$delta;
            $Char = $this->Characters->get($char_id);

            $T = $this->CharactersWeapons->get($join_id);
            $T->quantity += $delta;
            if ($T->quantity < 1) {
                if ($this->CharactersWeapons->delete($T)) {
                    // Announce
                    $this->Slack->announceCharacterEdit($Char);
                    $response = ['result' => 'success', 'data' => 0];
                }
            } else {
                if ($this->CharactersWeapons->save($T)) {
                    // Announce
                    $this->Slack->announceCharacterEdit($Char);
                    $response = ['result' => 'success', 'data' => $T->quantity];
                }
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function toggle($char_id = null, $link_id = null)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($char_id) && !is_null($link_id)) {
            $Char = $this->Characters->get($char_id, [
                'contain' => ['CharactersWeapons' => ['conditions' => ['CharactersWeapons.id' => $link_id]]]]);

            if (count($Char->characters_weapons) == 0) {
                // Non-existent link, invalid operation
            } else {
                $t = $Char->characters_weapons[0];
                $t->equipped = !$t->equipped;

                $Char->dirty('characters_weapons', true);
                if ($this->Characters->save($Char)) {
                    $response = ['result' => 'success', 'data' => $t->equipped];
                }
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }
}