<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CharactersController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CharactersController Test Case
 */
class CharactersControllerTest extends ControllerTestBase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.characters_talents',
        'app.characters',
        'app.characters_groups',
        'app.characters_careers',
        'app.characters_specialisations',
        'app.credits',
        'app.species',
        'app.groups',
        'app.groups_users',
        'app.users',
        'app.specialisations',
        'app.careers',
        'app.characters_armour',
        'app.armour',
        'app.talents',
        'app.characters_weapons',
        'app.weapons',
        'app.weapon_types',
        'app.skills',
        'app.stats',
        'app.characters_skills',
        'app.ranges',
        'app.characters_items',
        'app.items',
        'app.item_types',
        'app.obligations',
        'app.xp',
        'app.notes',
        'app.characters_notes'
    ];

    public function setUp()
    {
        $this->Characters = TableRegistry::get('Characters');
        parent::setUp();
    }

    /**
     * @covers App\Controller\CharactersController::initialize
     * @covers App\Controller\CharactersController::isAuthorized
     * @covers App\Controller\CharactersController::edit
     */
    public function testEditRequiresLogin()
    {
        $this->get('/characters/edit/1');
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * @covers App\Controller\CharactersController::edit
     */
    public function testEditByOwner()
    {
        $this->setUser('user');
        $this->get('/characters/edit/1');
        $this->assertResponseOk();
    }

    /**
     * @covers App\Controller\CharactersController::edit
     */
    public function testEditByGM()
    {
        $this->setUser('gm');
        $this->get('/characters/edit/1');
        $this->assertResponseOk();
    }


    /**
     * @covers App\Controller\CharactersController::delete
     */
    public function testxDeleteRequiresLogin()
    {
        $this->setJson();
        $this->get('/characters/delete/1');
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * @covers App\Controller\CharactersController::delete
     */
    public function testDeleteByGm()
    {
        $this->setUser('gm');
        $this->setJson();

        $charToDelete = $this->Characters->findByName('group1member1')->first();

        // Delete
        $this->post('/characters/delete.json', ['id' => $charToDelete->id]);
        $this->assertResponseOk();

        // Confirm
        $count = $this->Characters->findByName('group1member1')->count();
        $this->assertEquals(0, $count);
    }

    /**
     * @covers App\Controller\CharactersController::delete
     */
    public function testDeleteByOwner()
    {
        $this->setUser('user');
        $this->setJson();

        $charToDelete = $this->Characters->findByName('basic')->first();
        $this->assertInstanceOf('App\Model\Entity\Character', $charToDelete);

        // Delete
        $this->post('/characters/delete.json', ['id' => $charToDelete->id]);
        $this->assertResponseOk();

        // Check result data
        $expected = [
            'response' => [
                'result' => 'success',
                'data' => sprintf('%s has been deleted.', $charToDelete->name),
                ]
        ];
        $expected = json_encode($expected, JSON_PRETTY_PRINT);

        $this->assertEquals($expected, $this->_response->body());

        // Confirm
        $count = $this->Characters->findByName('basic')->count();
        $this->assertEquals(0, $count);
    }

}
