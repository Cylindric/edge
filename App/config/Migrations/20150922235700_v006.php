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

    }
}
