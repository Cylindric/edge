<?php
namespace App\Controller;

class XpController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Characters');
        $this->loadModel('Xp');
    }

    public function isAuthorized($user)
    {
        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
            'add',
            'edit',
            'delete'
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
        $this->request->allowMethod(['post', 'put']);

        $xp = $this->Xp->patchEntity($this->Xp->newEntity(), $this->request->data);
        if ($this->Xp->save($xp)) {
            $response = ['result' => 'success', 'data' => $xp];
            $response['total'] = $this->Xp->totalForCharacter($xp->character_id);

        } else {
            $response = ['result' => 'fail', 'data' => $xp];
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    public function edit($character_id = null)
    {
        $xp = $this->Xp->find()
            ->contain(['CreatedUser', 'Characters.Groups.GroupsUsers' => function ($q) {
                return $q->where(['GroupsUsers.gm' => true]);
            }])
            ->where(['character_id' => $character_id])
            ->order(['Xp.created DESC']);

        $total = $this->Xp->totalForCharacter($character_id);

        $this->set('xp', $xp);
        $this->set('total', $total);
        $this->set('_serialize', ['xp', 'total']);
    }

    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $response = ['result' => 'fail'];

        $xp = $this->Xp->get($this->request->data['xp_id']);
        if ($this->Xp->delete($xp)) {
            $response['result'] = 'success';
            $response['total'] = $this->Xp->totalForCharacter($xp->character_id);
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

}
