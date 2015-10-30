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
        $this->assertEquals('success', $response->response->result);
        $this->assertEquals(843, $response->response->data->value);
        $this->assertEquals(843, $response->response->total);

        // Confirm
        $count = $this->Xp->findByCharacterId($char->id)->count();
        $this->assertEquals(1, $count);
    }

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

}
