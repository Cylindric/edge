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
            'toggle_career',

        ])) {
            if ($this->request->is('post')) {
                if ($this->Characters->isOwnedBy($this->request->data['character_id'], $user['id'])) {
                    return true;
                }
            }
        }

        return parent::isAuthorized($user);
    }

    public function change()
    {
        $response = ['result' => 'fail', 'data' => null, 'Skill' => null];

        if ($this->request->is('post')) {
            $character_id = (int)$this->request->data['character_id'];
            $skill_id = (int)$this->request->data['skill_id'];
            $delta = (int)$this->request->data['delta'];

            $Character = $this->Characters->get($character_id, ['contain' => ['CharactersSkills']]);
            $Skill = $this->Skills->get($skill_id, ['contain' => ['Stats', 'CharactersSkills']]);
            $delta = (int)$delta;

            $response['Skill'] = $Skill;

            // Work out the current total level
            $query = $this->CharactersSkills->find();
            $query
                ->where(['character_id' => $character_id, 'skill_id' => $skill_id])
                ->select(['level' => $query->func()->sum('level')])
                ->hydrate(false);
            $current_level = $query->toArray()[0]['level'];

            // Work out the current minimum level
            $query = $this->CharactersSkills->find();
            $query
                ->where(['character_id' => $character_id, 'skill_id' => $skill_id, 'locked' => true])
                ->select([
                    'min' => $query->func()->sum('level'),
                    'career' => $query->func()->max('career'),
                ])
                ->hydrate(false);
            $result = $query->toArray()[0];
            $min_level = $result['min'];
            $is_career = (bool)$result['career'];

            // Work out the new level, and what it takes to get there.
            $new_level = $current_level + $delta;
            $new_training = $new_level - $min_level;

            // Remove all non-locked records
            $this->CharactersSkills
                ->query()
                ->delete()
                ->where(['character_id' => $character_id, 'skill_id' => $skill_id, 'locked' => false])
                ->execute();

            if ($delta == 0) {
                // Do nothing if we're not moving

            } elseif ($new_level < $min_level) {
                // Can't go below the minimum, so do nothing
                $new_level = $min_level;

            } else {
                // Create a new record to get us to the desired level
                $train = $this->CharactersSkills->newEntity();
                $train->character_id = $character_id;
                $train->skill_id = $skill_id;
                $train->level = $new_training;
                $Skill->characters_skills[] = $train;
                $Skill->dirty('characters_skills', true);
                if ($this->Skills->save($Skill)) {
                    $response['result'] = 'success';
                };
            }

            // Spend the XP
            if($response['result'] == 'success') {
                $this->loadModel('Xp');
                $xp = $this->Xp->newEntity();
                $xp->character_id = $character_id;
                if ($delta > 0) {
                    $xp->note = sprintf('Skill rank (%s %u)', $Skill->name, $new_level);
                    $xp->value = $new_level * -5;
                    if (!$is_career) {
                        $xp->value -= 5;
                    }
                } elseif ($delta < 0) {
                    $xp->note = sprintf('Refund for removing Skill %s %u', $Skill->name, $current_level);
                    $xp->value = $current_level * 5;
                    if (!$is_career) {
                        $xp->value += 5;
                    }
                }
                $this->Xp->save($xp);
            }

            // Announce
            if ($response['result'] == 'success')
                $this->Slack->announceCharacterEdit($Character);


            $response['Dice'] = $Skill->dice($Character);
            $response['Level'] = $new_level;

            $this->set('skill', $Skill);
        }

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    public function toggle_career()
    {
        $response = ['result' => 'fail', 'data' => null];

        if ($this->request->is('post')) {
            $character_id = $this->request->data['character_id'];
            $skill_id = $this->request->data['skill_id'];

            $query = $this->CharactersSkills->find()
                ->contain(['Characters', 'Skills'])
                ->where(['character_id' => $character_id])
                ->andWhere(['skill_id' => $skill_id])
                ->andWhere(['career' => true]);

            if ($query->count() == 0) {
                // No training in this Skill at all, create a new record to flag Career status in
                $link = $this->CharactersSkills->newEntity();
                $link->character_id = $character_id;
                $link->skill_id = $skill_id;
                $link->career = true;
                $link->locked = true;
            } else {
                $link = $query->first();
                $link->career = !$link->career;
            }
            if ($this->CharactersSkills->save($link)) {
                $response = ['result' => 'success', 'data' => $link->career];
            }
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

}