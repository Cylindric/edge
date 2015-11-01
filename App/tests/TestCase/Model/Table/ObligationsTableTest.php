<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class ObligationsTableTest extends TestCase
{
    public $fixtures = [
        'app.characters',
        'app.obligations',
        'app.users',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->Obligations = TableRegistry::get('Obligations');
    }

    public function testGetTotalForCharacter()
    {
        $this->Characters = TableRegistry::get('Characters');
        $char = $this->Characters->findByName('no obligations')->first();
        $this->assertInstanceOf('App\Model\Entity\Character', $char);

        // Add some known obligations
        $new = $this->Obligations->newEntity();
        $new->character_id = $char->id;
        $new->value = 829;
        $new->created_by = $char->user_id;
        $new->modified_by = $char->user_id;
        $this->Obligations->save($new);

        // Check total for single record
        $total = $this->Obligations->totalForCharacter($char->id);
        $this->assertEquals(829, $total);

        // Add another record
        $new = $this->Obligations->newEntity();
        $new->character_id = $char->id;
        $new->value = 439;
        $new->created_by = $char->user_id;
        $new->modified_by = $char->user_id;
        $this->Obligations->save($new);

        // Check total for multiple records
        $total = $this->Obligations->totalForCharacter($char->id);
        $this->assertEquals(829 + 439, $total);
    }

    public function testGetTotalForCharacterReturnsZeroInsteadOfNull()
    {
        $total = $this->Obligations->totalForCharacter(-1);
        $this->assertSame(0, $total);
    }
}