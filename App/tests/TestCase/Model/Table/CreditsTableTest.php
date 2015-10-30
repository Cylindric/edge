<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class CreditsTableTest extends TestCase
{
    public $fixtures = [
        'app.characters',
        'app.credits',
        'app.users',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->Credits = TableRegistry::get('Credits');
    }

    public function testGetTotalForCharacter()
    {
        $this->Characters = TableRegistry::get('Characters');
        $char = $this->Characters->findByName('no credits')->first();
        $this->assertInstanceOf('App\Model\Entity\Character', $char);

        // Add some known credits
        $new = $this->Credits->newEntity();
        $new->character_id = $char->id;
        $new->value = 829;
        $new->created_by = $char->user_id;
        $new->modified_by = $char->user_id;
        $this->Credits->save($new);

        // Check total for single record
        $total = $this->Credits->totalForCharacter($char->id);
        $this->assertEquals(829, $total);

        // Add another record
        $new = $this->Credits->newEntity();
        $new->character_id = $char->id;
        $new->value = 439;
        $new->created_by = $char->user_id;
        $new->modified_by = $char->user_id;
        $this->Credits->save($new);

        // Check total for multiple records
        $total = $this->Credits->totalForCharacter($char->id);
        $this->assertEquals(829 + 439, $total);
    }

}