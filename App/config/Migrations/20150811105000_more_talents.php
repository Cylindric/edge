<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class MoreTalents extends AbstractMigration
{

    public function change()
    {
		$table = $this->table('talents');
        $table->removeColumn('description')
            ->removeColumn('activation_type')
            ->removeColumn('page')
            ->update();

        $talents = TableRegistry::get('Talents');
        $data = [
			['name' => 'Heroic Fortitude', 'ranked' => false],
			['name' => 'Hidden Storag', 'ranked' => true],
			['name' => 'Hold Together', 'ranked' => false],
			['name' => 'Hunter', 'ranked' => true],
			['name' => 'Indistinguishable', 'ranked' => true],
			['name' => 'Insight', 'ranked' => false],
			['name' => 'Inspiring Rhetoric', 'ranked' => false],
			['name' => 'Inpsiring Rhetoric (Improved)', 'ranked' => false],
			['name' => 'Inspiring Rhetoric (Supreme)', 'ranked' => false],
			['name' => 'Intense Focus', 'ranked' => false],
			['name' => 'Intense Presence', 'ranked' => false],
			['name' => 'Intimidating', 'ranked' => true],
			['name' => 'Inventor', 'ranked' => true],
			['name' => 'Jump Up', 'ranked' => false],
			['name' => 'Jury Rigged', 'ranked' => true],
			['name' => 'Kill with Kindness', 'ranked' => true],
			['name' => 'Knockdown', 'ranked' => false],
			['name' => 'Know Somebody', 'ranked' => true],
			['name' => 'Knowledge Specialization', 'ranked' => true],
			['name' => 'Known Schematic', 'ranked' => false],
			['name' => 'Let\'s Ride', 'ranked' => false],
			['name' => 'Lethal Blows', 'ranked' => true],
			['name' => 'Master Doctor', 'ranked' => false],
			['name' => 'Master Metchant', 'ranked' => false],
			['name' => 'Master of Shadows', 'ranked' => false],
			['name' => 'Master Pilot', 'ranked' => false],
			['name' => 'Master Slicer', 'ranked' => false],
			['name' => 'Master Starhopper', 'ranked' => false],
			['name' => 'Mental Fortress', 'ranked' => false],
			['name' => 'Natural Brawler', 'ranked' => false],
			['name' => 'Natural Charmer', 'ranked' => false],
			['name' => 'Natural Doctor', 'ranked' => false],
			['name' => 'Natural Enforcer', 'ranked' => false],
			['name' => 'Natural Hunter', 'ranked' => false],
			['name' => 'Natural Marksman', 'ranked' => false],
			['name' => 'Natural Negotiator', 'ranked' => false],
			['name' => 'Natural Outdoorsman', 'ranked' => false],
			['name' => 'Natural Pilot', 'ranked' => false],
			['name' => 'Natural Programmer', 'ranked' => false],
			['name' => 'Natural Rogue', 'ranked' => false],
			['name' => 'Natural Scholar', 'ranked' => false],
			['name' => 'Natural Tinkerer', 'ranked' => false],
			['name' => 'Nobody\'s Fool', 'ranked' => true],
			['name' => 'Outdoorsman', 'ranked' => true],
			['name' => 'Overwhelm Emotions', 'ranked' => false],
			['name' => 'Plausible Deniability', 'ranked' => true],
			['name' => 'Point Blank', 'ranked' => true],
			['name' => 'Precise Aim', 'ranked' => true],
			['name' => 'Pressure Point', 'ranked' => false],
			['name' => 'Quick Draw', 'ranked' => false],
			['name' => 'Quick Strike', 'ranked' => true],
			['name' => 'Rapid Reaction', 'ranked' => true],
			['name' => 'Rapid Recovery', 'ranked' => true],
			['name' => 'Redundant Systems', 'ranked' => false],
			['name' => 'Researcher', 'ranked' => true],
			['name' => 'Resolve', 'ranked' => true],
			['name' => 'Respected Scholar', 'ranked' => true],
			['name' => 'Scathing Tirade', 'ranked' => false],
			['name' => 'Scathing Tirade (Improved)', 'ranked' => false],
			['name' => 'Scathing Tirade (Supreme)', 'ranked' => false],
			['name' => 'Second Wind', 'ranked' => true],
			['name' => 'Sense Danger', 'ranked' => false],
			['name' => 'Sense Emotions', 'ranked' => false],
			['name' => 'Shortcut', 'ranked' => true],
			['name' => 'Side Step', 'ranked' => true],
			['name' => 'Sixth Sense', 'ranked' => false],
			['name' => 'Skilled Jockey', 'ranked' => true],
			['name' => 'Skilled Slicer', 'ranked' => false],
			['name' => 'Smooth Talker', 'ranked' => true],
			['name' => 'Sniper Shot', 'ranked' => true],
			['name' => 'Soft Spot', 'ranked' => false],
			['name' => 'Solid Repairs', 'ranked' => true],
			['name' => 'Spare Clip', 'ranked' => false],
			['name' => 'Speaks Binary', 'ranked' => true],
			['name' => 'Stalker', 'ranked' => true],
			['name' => 'Steely Nerves', 'ranked' => false],
			['name' => 'Stim Application', 'ranked' => false],
			['name' => 'Stim Application (Improved)', 'ranked' => false],
			['name' => 'Stim Application (Supreme)', 'ranked' => false],
			['name' => 'Street Smarts', 'ranked' => true],
			['name' => 'Stroke of Genius', 'ranked' => false],
			['name' => 'Strong Armor', 'ranked' => false],
			['name' => 'Stunning Blow', 'ranked' => false],
			['name' => 'Stunning Blow (Improved)', 'ranked' => false],
			['name' => 'Superior Reflexes', 'ranked' => false],
			['name' => 'Surgeon', 'ranked' => true],
			['name' => 'Swift', 'ranked' => false],
			['name' => 'Targeted Blow', 'ranked' => false],
			['name' => 'Technical Aptitude', 'ranked' => true],
			['name' => 'Tinkerer', 'ranked' => true],
			['name' => 'Touch of Fate', 'ranked' => false],
			['name' => 'Toughened', 'ranked' => true],
			['name' => 'Tricky Target', 'ranked' => false],
			['name' => 'True Aim', 'ranked' => true],
			['name' => 'Uncanny Reactions', 'ranked' => true],
			['name' => 'Uncanny Senses', 'ranked' => true],
			['name' => 'Utility Belt', 'ranked' => false],
			['name' => 'Utinni!', 'ranked' => true],
			['name' => 'Well Rounded', 'ranked' => true],
			['name' => 'Wheel and Deal', 'ranked' => true],
        ];
        $data = $talents->newEntities($data);
        foreach ($data as $entity) {
            $talents->save($entity);
        }
    }
}
