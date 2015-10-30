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

    public function testEditRequiresLogin()
    {
        $this->get('/characters/edit/1');
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function testEditByGM()
    {
        $this->setGmUser();
        $this->get('/characters/edit/1');
        $this->assertResponseOk();
    }

    public function testEdit()
    {
        $this->setNormalUser();
        $this->get('/characters/edit/1');
        $this->assertResponseOk();
    }



    public function testxDeleteRequiresLogin()
    {
        $this->setJson();
        $this->get('/characters/delete/1');
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function testDeleteByGm()
    {
        $this->setGmUser();
        $this->setJson();

        $charToDelete = $this->Characters->findByName('group1member1')->first();

        // Delete
        $this->post('/characters/delete.json', ['id' => $charToDelete->id]);
        $this->assertResponseOk();

        // Confirm
        $count = $this->Characters->findByName('group1member1')->count();
        $this->assertEquals(0, $count);
    }

    public function testDeleteByOwner()
    {
        $this->setNormalUser();
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

    /*
        public function testEditStats()
        {
            $this->markTestIncomplete('Not implemented yet.');
        }

        public function testEditNotes()
        {
            $this->markTestIncomplete('Not implemented yet.');
        }

        public function testEditSkills()
        {
            $this->markTestIncomplete('Not implemented yet.');
        }

        public function testChangeStat()
        {
            $this->markTestIncomplete('Not implemented yet.');
        }

        public function testGetSoak()
        {
            $this->markTestIncomplete('Not implemented yet.');
        }

        public function testGetStrainThreshold()
        {
            $this->markTestIncomplete('Not implemented yet.');
        }

        public function testChangeAttribute()
        {
            $this->markTestIncomplete('Not implemented yet.');
        }

        public function testJoinGroup()
        {
            $this->markTestIncomplete('Not implemented yet.');
        }
    */

}
