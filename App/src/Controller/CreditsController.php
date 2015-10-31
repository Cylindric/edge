<?php
namespace App\Controller;

use Cake\Network\Exception\InternalErrorException;

class CreditsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Characters');
        $this->loadModel('Credits');
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
        $response = array();

        $credit = $this->Credits->newEntity();
        $credit = $this->Credits->patchEntity($credit, $this->request->data);
        if ($this->Credits->save($credit)) {
            $response['result'] = 'success';
            $response['data'] = $credit;
            $response['total'] = $this->Credits->totalForCharacter($credit->character_id);

        } else {
            $response['result'] = 'fail';
            $response['data'] = $credit;
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

    public function edit($character_id = null)
    {
        $credits = $this->Credits->find();
        $credits
            ->join([
                'created_user' => [
                    'table' => 'users',
                    'type' => 'LEFT',
                    'conditions' => 'Credits.created_by = created_user.id',
                ],
                'characters' => [
                    'table' => 'characters',
                    'type' => 'LEFT',
                    'conditions' => 'Credits.character_id = characters.id',
                ],
                'groups' => [
                    'table' => 'groups',
                    'type' => 'LEFT',
                    'conditions' => 'characters.group_id = groups.id',
                ],
                'gms' => [
                    'table' => 'groups_users',
                    'type' => 'LEFT',
                    'conditions' => 'gms.group_id = groups.id AND gms.gm = 1',
                ],
                'gm' => [
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => 'gms.user_id = gm.id',
                ],
            ])
            ->select([
                'Credits.id', 'Credits.created', 'Credits.value', 'Credits.note',
                'created_user.id', 'created_user.username',
                'characters.id',
                'groups.id',
                'gm.id', 'gm.username',
                'created_by_gm' => $credits->newExpr()->addCase($credits->newExpr()->add(['gm.id = Credits.created_by']), 1, 'integer'),
            ])
            ->where(['character_id' => $character_id])
            ->order('Credits.created DESC');

        $total = $this->Credits->totalForCharacter($character_id);

        $this->set('credits', $credits->toArray());
        $this->set('total', $total);
        $this->set('_serialize', ['credits', 'total']);
    }


    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $response = ['result' => 'fail'];

        $credit = $this->Credits->get($this->request->data['credit_id']);
        if ($this->Credits->delete($credit)) {
            $response['result'] = 'success';
            $response['total'] = $this->Credits->totalForCharacter($credit->character_id);
        } else {
            throw new InternalErrorException('Failed to delete Credits record!');
        }

        $this->set('response', $response);
        $this->set('_serialize', 'response');
    }

}
