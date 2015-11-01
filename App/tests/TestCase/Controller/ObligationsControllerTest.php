<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ObligationsController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;

class ObligationsControllerTest extends ControllerTestBase
{

    public $fixtures = [
        'app.characters',
        'app.obligations',
        'app.users',
        'app.groups',
        'app.groups_users',
     ];

    public function setUp()
    {
        $this->Characters = TableRegistry::get('Characters');
        $this->Obligations = TableRegistry::get('Obligations');
        parent::setUp();
    }

    public function testAddByNobody()
    {
        $this->setJson();

        $this->post('/obligations/add.json', [
            'character_id' => 1,
            'value' => 843,
            'note' => 'test Obligation',
        ]);
        $this->assertRedirect();

        // Confirm
        $count = $this->Obligations->findByCharacterId(7)->count();
        $this->assertEquals(0, $count);
    }

    public function testAddByOwner()
    {
        $this->setUser('user');
        $this->setJson();

        $char = $this->Characters->findByName('no obligations')->first();
        $this->assertInstanceOf('App\Model\Entity\Character', $char);

        $this->post('/obligations/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test Obligation',
        ]);
        $this->assertResponseOk();

        // Check result data
        $response = json_decode($this->_response->body());
        $this->assertEquals('success', $response->result);
        $this->assertEquals(843, $response->data->value);
        $this->assertEquals(843, $response->total);

        // Confirm
        $count = $this->Obligations->findByCharacterId($char->id)->count();
        $this->assertEquals(1, $count);
    }

    public function testAddByGm()
    {
        $this->setUser('gm');
        $this->setJson();

        $char = $this->Characters->findByName('no obligations')->first();

        $this->post('/obligations/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test Obligation',
        ]);
        $this->assertResponseOk();
    }

    public function testAddByAdmin()
    {
        $this->setUser('admin');
        $this->setJson();

        $char = $this->Characters->findByName('no obligations')->first();

        $this->post('/obligations/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test Obligation',
        ]);
        $this->assertResponseOk();
    }

    public function testAddByOther()
    {
        $this->setUser('other');
        $this->setJson();

        $char = $this->Characters->findByName('no obligations')->first();

        $this->post('/obligations/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test Obligation',
        ]);
        $this->assertRedirect();

        // Confirm
        $count = $this->Obligations->findByCharacterId($char->id)->count();
        $this->assertEquals(0, $count);
    }

    public function testEdit()
    {
        $this->setUser('user');
        $this->setJson();
        $char = $this->Characters->findByName('basic')->first();

        $this->get('/obligations/edit/'.$char->id.'.json');
        $this->assertResponseOk();

        $response = json_decode($this->_response->body());
        $this->assertObjectHasAttribute('obligations', $response);
        $this->assertObjectHasAttribute('total', $response);
    }

    public function testDeleteByOwner()
    {
        $this->setUser('user');
        $this->setJson();

        $char = $this->Characters->findByName('basic')->first();
        $record = $this->Obligations->findByCharacterId($char->id)->first();

        // Delete
        $this->post('/obligations/delete.json', [
            'character_id' => $char->id,
            'obligation_id' => $record->id,
        ]);
        $this->assertResponseOk();
        $response = json_decode($this->_response->body());
        $this->assertObjectHasAttribute('total', $response);

        // Confirm
        $count = $this->Obligations->findById($record->id)->count();
        $this->assertEquals(0, $count);
    }
}
