<?php
namespace App\Controller;

class CharacterSkillsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('CharactersSkills');
        $this->loadModel('Characters');
        $this->loadModel('Skills');
    }

    public function isAuthorized($user)
    {
        // These require a valid Character Id that the user owns
        if (in_array($this->request->action, [
            'change',

        ])) {
            $characterId = (int)$this->request->params['pass'][0];
            if ($this->Characters->isOwnedBy($characterId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function change($char_id = null, $skill_id = null, $delta = 1)
    {
        $Character = $this->Characters->get($char_id, ['contain' => ['CharactersSkills']]);
        $Skill = $this->Skills->get($skill_id, ['contain' => ['Stats', 'CharactersSkills']]);
        $delta = (int)$delta;

        $response = [
            'result' => 'fail',
            'Skill' => $Skill
        ];

        // Work out the current total level
        $query = $this->CharactersSkills->find();
        $query
            ->where(['character_id' => $char_id, 'skill_id' => $skill_id])
            ->select(['min' => $query->func()->sum('level')])
            ->hydrate(false);
        $current_level = $query->toArray()[0]['min'];

        // Work out the current minimum level
        $query = $this->CharactersSkills->find();
        $query
            ->where(['character_id' => $char_id, 'skill_id' => $skill_id, 'locked' => true])
            ->select(['min' => $query->func()->sum('level')])
            ->hydrate(false);
        $min_level = $query->toArray()[0]['min'];

        // Work out the new level, and what it takes to get there.
        $new_level = $current_level + $delta;
        $new_training = $new_level - $min_level;

        // Remove all non-locked records
        $this->CharactersSkills
            ->query()
            ->delete()
            ->where(['character_id' => $char_id, 'skill_id' => $skill_id, 'locked' => false])
            ->execute();


        if ($delta == 0) {
            // Do nothing if we're not moving

        } elseif ($new_level < $min_level) {
            // Can't go below the minimum, so do nothing
            $new_level = $min_level;

        } else {
            // Create a new record to get us to the desired level
            $train = $this->CharactersSkills->newEntity();
            $train->character_id = $char_id;
            $train->skill_id = $skill_id;
            $train->level = $new_training;
            $Skill->characters_skills[] = $train;
            $Skill->dirty('characters_skills', true);
            if ($this->Skills->save($Skill)) {
                $response['result'] = 'success';
            };
        }

        // Announce
        if ($response['result'] == 'success')
            $this->Slack->announceCharacterEdit($Character);


        $response['Dice'] = $Skill->dice($Character);
        $response['Level'] = $new_level;

        $this->set('skill', $Skill);
        $this->set('response', $response);
        $this->set('_serialize', ['response']);

        $this->render($this->request->is('ajax'));
    }

}