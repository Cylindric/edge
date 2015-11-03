<?php
namespace App\Test\TestCase\Controller;

use App\Controller\XpController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;

class XpControllerTest extends ControllerTestBase
{

    public $fixtures = [
        'app.characters',
        'app.xp',
        'app.users',
        'app.groups',
        'app.groups_users',
     ];

    public function setUp()
    {
        $this->Characters = TableRegistry::get('Characters');
        $this->Xp = TableRegistry::get('Xp');
        parent::setUp();
    }

    /**
     * @covers App\Controller\XpController::initialize
     * @covers App\Controller\XpController::isAuthorized
     * @covers App\Controller\XpController::add
     */
    public function testAddByOwner()
    {
        $this->setUser('user');
        $this->setJson();

        $char = $this->Characters->findByName('no xp')->first();
        $this->assertInstanceOf('App\Model\Entity\Character', $char);

        $this->post('/xp/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test XP',
        ]);
        $this->assertResponseOk();

        // Check result data
        $response = json_decode($this->_response->body());
        $this->assertEquals('success', $response->result);
        $this->assertEquals(843, $response->data->value);
        $this->assertEquals(843, $response->total);

        // Confirm
        $count = $this->Xp->findByCharacterId($char->id)->count();
        $this->assertEquals(1, $count);
    }

    /**
     * @covers App\Controller\XpController::add
     */
    public function testAddByNobody()
    {
        $this->setJson();

        $char = $this->Characters->findByName('no xp')->first();
        $this->assertInstanceOf('App\Model\Entity\Character', $char);

        $this->post('/xp/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test XP',
        ]);
        $this->assertRedirect();

        // Confirm
        $count = $this->Xp->findByCharacterId($char->id)->count();
        $this->assertEquals(0, $count);
    }

    /**
     * @covers App\Controller\XpController::add
     */
    public function testAddByGm()
    {
        $this->setUser('gm');
        $this->setJson();

        $char = $this->Characters->findByName('no xp')->first();

        $this->post('/xp/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test XP',
        ]);
        $this->assertResponseOk();
    }

    /**
     * @covers App\Controller\XpController::add
     */
    public function testAddByAdmin()
    {
        $this->setUser('admin');
        $this->setJson();

        $char = $this->Characters->findByName('no xp')->first();

        $this->post('/xp/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test XP',
        ]);
        $this->assertResponseOk();
    }

    /**
     * @covers App\Controller\XpController::add
     */
    public function testAddByOther()
    {
        $this->setUser('other');
        $this->setJson();

        $char = $this->Characters->findByName('no xp')->first();

        $this->post('/xp/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test XP',
        ]);
        $this->assertRedirect();

        // Confirm
        $count = $this->Xp->findByCharacterId($char->id)->count();
        $this->assertEquals(0, $count);
    }

    /**
     * @covers App\Controller\XpController::edit
     */
    public function testEditByOwner()
    {
        $this->setUser('user');
        $this->setJson();
        $char = $this->Characters->findByName('basic')->first();

        $this->get('/xp/edit/'.$char->id.'.json');
        $this->assertResponseOk();

        $response = json_decode($this->_response->body());
        $this->assertObjectHasAttribute('xp', $response);
        $this->assertObjectHasAttribute('total', $response);
    }

    /**
     * @covers App\Controller\XpController::delete
     */
    public function testDeleteByOwner()
    {
        $this->setUser('user');
        $this->setJson();

        $char = $this->Characters->findByName('basic')->first();
        $record = $this->Xp->findByCharacterId($char->id)->first();

        // Delete
        $this->post('/xp/delete.json', [
            'character_id' => $char->id,
            'xp_id' => $record->id,
        ]);
        $this->assertResponseOk();
        $response = json_decode($this->_response->body());
        $this->assertObjectHasAttribute('total', $response);

        // Confirm
        $count = $this->Xp->findById($record->id)->count();
        $this->assertEquals(0, $count);
    }

}
