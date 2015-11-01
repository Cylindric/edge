<?php
namespace App\Controller;

class ObligationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Characters');
        $this->loadModel('Obligations');
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
        $obligation = $this->Obligations->newEntity();
        if ($this->request->is('post')) {
            $obligation = $this->Obligations->patchEntity($obligation, $this->request->data);
            if ($this->Obligations->save($obligation)) {
                $response = ['result' => 'success', 'data' => $obligation];

                $query = $this->Obligations->find();
                $query
                    ->where(['character_id' => $obligation->character_id])
                    ->select(['total' => $query->func()->sum('value')])
                    ->hydrate(false);
                $response['total'] = $query->toArray()[0]['total'];
            } else {
                $response = ['result' => 'fail', 'data' => $obligation];
            }
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    public function edit($character_id = null)
    {
        $obligations = $this->Obligations
            ->find()
            ->contain(['CreatedUser', 'Characters.Groups.GroupsUsers' => function ($q) {
                return $q->where(['GroupsUsers.gm' => true]);
            }])
            ->where(['character_id' => $character_id])
            ->order('Obligations.created DESC');

        $query = $this->Obligations->find();
        $query
            ->where(['character_id' => $character_id])
            ->select(['total' => $query->func()->sum('value')])
            ->hydrate(false);
        $total = $query->toArray()[0]['total'];

        $this->set('obligations', $obligations->toArray());
        $this->set('total', $total);
        $this->set('_serialize', ['obligations', 'total']);
    }

    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $response = ['result' => 'fail'];

        $obligation = $this->Obligations->get($this->request->data['obligation_id']);
        if ($this->Obligations->delete($obligation)) {
            $response['result'] = 'success';
            $response['total'] = $this->Obligations->totalForCharacter($obligation->character_id);
        } else {
            throw new InternalErrorException('Failed to delete Obligation record!');
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

}

