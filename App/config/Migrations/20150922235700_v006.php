<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class v006 extends AbstractMigration
{
    public function change()
    {
        $conn = ConnectionManager::get('default');

        $this->table('species')
            ->removeColumn('class')
            ->update();

        $this->table('talents')
            ->addColumn('description', 'string', ['default' => null, 'limit' => 255, 'null' => true])
            ->update();

        $conn->query("UPDATE talents SET description = '+{rank} Soak.' WHERE name = 'Enduring'");
        $conn->query("UPDATE talents SET description = '+{rank} Strain.' WHERE name = 'Grit'");
        $conn->query("UPDATE talents SET description = '+{dice.boost.rank} to all Stealth and Coordination checks.' WHERE name = 'Stalker'");
        $conn->query("UPDATE talents SET description = 'Perform {check.average.medicine} to increase one characteristic of an engaged character by 1; suffer 1 Strain.' WHERE name = 'Stim Application'");
        $conn->query("UPDATE talents SET description = '+{rank} wound healed.' WHERE name = 'Surgeon'");
        $conn->query("UPDATE talents SET description = 'When targeted by a combat check, may suffer up to {rank} Strain to increase difficulty by {rank}.' WHERE name = 'Dodge'");
        $conn->query("UPDATE talents SET description = 'On successful attack, spend 1 Destiny Point to add {stat.ag} Damage to one hit.' WHERE name = 'Targeted Blow'");
        $conn->query("UPDATE talents SET description = 'Once per session, reduce rarity of a legal item by {rank}.' WHERE name = 'Know Somebody'");
        $conn->query("UPDATE talents SET description = 'On purchase, chose one of Charm, Coercion, Negotiation or Deception. On checks of that skill, may spend {symbol.triumph} to gain {symbol.success.rank}.' WHERE name = 'Smooth Talker'");
        $conn->query("UPDATE talents SET description = 'When selling legal goods to a merchant, gain {rank}0% more credits.' WHERE name = 'Wheel and Deal'");
        $conn->query("UPDATE talents SET description = 'When making Brawl checks, +1 Damage and Critical Rating 3.' WHERE name = 'Claws'");

        // Enter the Unknown weapons
        $range_short = 3;
        $range_long = 4;
        $range_extreme = 5;

        $wt = TableRegistry::get('WeaponTypes');
        $energy = $wt->findByName('Energy Weapons')->first()->id;
        $slugs = $wt->findByName('Slugthrowers')->first()->id;
        $other = $wt->findByName('Explosives and Other Weapons')->first()->id;

        $skills = TableRegistry::get('Skills');
        $ranged_light = $skills->findByName('Ranged - Light')->first()->id;
        $ranged_heavy = $skills->findByName('Ranged - Heavy')->first()->id;
        $table = TableRegistry::get('Weapons');
        $data = [
            ['name' => 'X-30 Lancer', 'weapon_type_id' => $energy, 'skill_id' => $ranged_light, 'damage' => 5, 'crit' => 4, 'range_id' => $range_long, 'encumbrance' => 1, 'hp' => 3, 'value' => 1000, 'restricted' => false, 'rarity' => 5, 'special' => 'Accurate 1, Pierce 2'],
            ['name' => 'E11s', 'weapon_type_id' => $energy, 'skill_id' => $ranged_heavy, 'damage' => 10, 'crit' => 3, 'range_id' => $range_extreme, 'encumbrance' => 6, 'hp' => 3, 'value' => 3500, 'restricted' => true, 'rarity' => 7, 'special' => 'Accurate 1, Cumbersome 3, Pierce 2, Slow Firing 1'],
            ['name' => 'LBR-9', 'weapon_type_id' => $energy, 'skill_id' => $ranged_heavy, 'damage' => 10, 'crit' => 0, 'range_id' => $range_long, 'encumbrance' => 6, 'hp' => 4, 'value' => 2800, 'restricted' => false, 'rarity' => 4, 'special' => 'Disorient 2, Stun Damage'],

            ['name' => 'Model 77', 'weapon_type_id' => $slugs, 'skill_id' => $ranged_heavy, 'damage' => 6, 'crit' => 0, 'range_id' => $range_long, 'encumbrance' => 3, 'hp' => 3, 'value' => 1100, 'restricted' => false, 'rarity' => 6, 'special' => 'Pierce 4, Stun Damage'],
            ['name' => 'Model 38', 'weapon_type_id' => $slugs, 'skill_id' => $ranged_heavy, 'damage' => 6, 'crit' => 3, 'range_id' => $range_extreme, 'encumbrance' => 5, 'hp' => 4, 'value' => 3000, 'restricted' => false, 'rarity' => 6, 'special' => 'Accurate 2, Pierce 3'],
            ['name' => 'Hammer', 'weapon_type_id' => $slugs, 'skill_id' => $ranged_heavy, 'damage' => 8, 'crit' => 4, 'range_id' => $range_short, 'encumbrance' => 5, 'hp' => 4, 'value' => 1500, 'restricted' => false, 'rarity' => 5, 'special' => 'Blast 6, Knockdown'],

            ['name' => 'Net Gun', 'weapon_type_id' => $other, 'skill_id' => $ranged_heavy, 'damage' => 3, 'crit' => 0, 'range_id' => $range_short, 'encumbrance' => 4, 'hp' => 2, 'value' => 750, 'restricted' => false, 'rarity' => 5, 'special' => 'Ensnare 5'],
            ['name' => 'Glop Grenade', 'weapon_type_id' => $other, 'skill_id' => $ranged_light, 'damage' => 0, 'crit' => 0, 'range_id' => $range_short, 'encumbrance' => 1, 'hp' => 0, 'value' => 100, 'restricted' => false, 'rarity' => 6, 'special' => 'Blast -, Ensnare 3'],
        ];
        foreach ($table->newEntities($data) as $entity) {
            $table->save($entity);
        }
    }
}
