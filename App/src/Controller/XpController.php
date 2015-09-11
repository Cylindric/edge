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
        if ($this->request->action === 'index') {
            return true;
        }

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
        $xp = $this->Xp->newEntity();
        if ($this->request->is('post')) {
            $xp = $this->Xp->patchEntity($xp, $this->request->data);
            if ($this->Xp->save($xp)) {
                $response = ['result' => 'success', 'data' => $xp];
            } else {
                $response = ['result' => 'fail', 'data' => $xp];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function edit($character_id = null)
    {
        $xp = $this->Xp->find()
            ->contain(['CreatedUser', 'Characters.Groups.GroupsUsers' => function($q){return $q->where(['GroupsUsers.gm' => true]);} ])
            ->where(['character_id' => $character_id])
            ->order(['Xp.created DESC']);

        $query = $this->Xp->find();
        $query
            ->where(['character_id' => $character_id])
            ->select(['total' => $query->func()->sum('value')])
            ->hydrate(false);
        $total = $query->toArray()[0]['total'];

        $this->set('xp', $xp);
        $this->set('total', $total);
        $this->set('_serialize', ['xp']);
    }

    public function delete($xp_id)
    {
        $response = ['result' => 'fail', 'data' => null];

        if (!is_null($xp_id)) {
            if ($this->Xp->delete($this->Xp->get($xp_id))) {
                $response = ['result' => 'success', 'data' => null];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

}
