<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CreditsController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;

class CreditsControllerTest extends ControllerTestBase
{

    public $fixtures = [
        'app.characters',
        'app.credits',
        'app.users',
        'app.groups',
        'app.groups_users',
    ];

    public function setUp()
    {
        $this->Characters = TableRegistry::get('Characters');
        $this->Credits = TableRegistry::get('Credits');
        parent::setUp();
    }

    public function testAddByNobody()
    {
        $this->setJson();

        $char = $this->Characters->findByName('no credits')->first();
        $this->assertInstanceOf('App\Model\Entity\Character', $char);

        $this->post('/credits/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test credits',
        ]);
        $this->assertRedirect();

        // Confirm
        $count = $this->Credits->findByCharacterId($char->id)->count();
        $this->assertEquals(0, $count);
    }

    public function testAddByOwner()
    {
        $this->setUser('user');
        $this->setJson();

        $char = $this->Characters->findByName('no credits')->first();
        $this->assertInstanceOf('App\Model\Entity\Character', $char);

        $this->post('/credits/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test credits',
        ]);
        $this->assertResponseOk();

        // Check result data
        $response = json_decode($this->_response->body());
        $this->assertEquals('success', $response->result);
        $this->assertEquals(843, $response->data->value);
        $this->assertEquals(843, $response->total);

        // Confirm
        $count = $this->Credits->findByCharacterId($char->id)->count();
        $this->assertEquals(1, $count);
    }

    public function testAddByGm()
    {
        $this->setUser('gm');
        $this->setJson();

        $char = $this->Characters->findByName('no credits')->first();

        $this->post('/credits/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test credits',
        ]);
        $this->assertResponseOk();
    }

    public function testAddByAdmin()
    {
        $this->setUser('admin');
        $this->setJson();

        $char = $this->Characters->findByName('no credits')->first();

        $this->post('/credits/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test credits',
        ]);
        $this->assertResponseOk();
    }

    public function testAddByOther()
    {
        $this->setUser('other');
        $this->setJson();

        $char = $this->Characters->findByName('no credits')->first();

        $this->post('/credits/add.json', [
            'character_id' => $char->id,
            'value' => 843,
            'note' => 'test credits',
        ]);
        $this->assertRedirect();

        // Confirm
        $count = $this->Credits->findByCharacterId($char->id)->count();
        $this->assertEquals(0, $count);
    }

    public function testDeleteByOwner()
    {
        $this->setUser('user');
        $this->setJson();

        $char = $this->Characters->findByName('basic')->first();
        $record = $this->Credits->findByCharacterId($char->id)->first();

        // Delete
        $this->post('/credits/delete.json', [
            'character_id' => $char->id,
            'credit_id' => $record->id,
        ]);
        $this->assertResponseOk();
        $response = json_decode($this->_response->body());
        $this->assertObjectHasAttribute('total', $response);

        // Confirm
        $count = $this->Credits->findById($record->id)->count();
        $this->assertEquals(0, $count);
    }

}
