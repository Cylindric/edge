<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class XpTableTest extends TestCase
{
    public $fixtures = [
        'app.characters',
        'app.xp',
        'app.users',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->Xp = TableRegistry::get('Xp');
    }

    public function testGetTotalForCharacter()
    {
        $this->Characters = TableRegistry::get('Characters');
        $char = $this->Characters->findByName('no xp')->first();
        $this->assertInstanceOf('App\Model\Entity\Character', $char);

        // Add some known xp
        $new = $this->Xp->newEntity();
        $new->character_id = $char->id;
        $new->value = 829;
        $new->created_by = $char->user_id;
        $new->modified_by = $char->user_id;
        $this->Xp->save($new);
//
//        // Check total for single record
//        $total = $this->Xp->totalForCharacter($char->id);
//        $this->assertEquals(829, $total);
//
//        // Add another record
//        $new = $this->Xp->newEntity();
//        $new->character_id = $char->id;
//        $new->value = 439;
//        $new->created_by = $char->user_id;
//        $new->modified_by = $char->user_id;
//        $this->Xp->save($new);
//
//        // Check total for multiple records
//        $total = $this->Xp->totalForCharacter($char->id);
//        $this->assertEquals(829 + 439, $total);
    }

    public function testGetTotalForCharacterReturnsZeroInsteadOfNull()
    {
        $total = $this->Xp->totalForCharacter(-1);
        $this->assertSame(0, $total);
    }
}