<?php
namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\Routing\Router;

class CharactersControllerTest extends IntegrationTestCase
{
    public $fixtures = [
        'app.characters',
        'app.characters_talents',
        'app.skills',
        'app.stats',
        'app.species',
        'app.training',
        'app.talents',
    ];

    public function setUp()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'Admin',
                    'role' => 'admin'
                ]
            ]
        ]);
    }

    public function testIndex()
    {
        $this->get('characters');
        $this->assertResponseOk();
    }

    public function testChangeStatIncreaseFrom0To1()
    {
        $char_id = 1;
        $stat = 'ag';
        $stat_code = 'stat_' . $stat;

        $Characters = TableRegistry::get('Characters');
        $char = $Characters->get($char_id);
        $char->$stat_code = 0;
        $Characters->save($char);

        $original_value = $char->$stat_code;
        $expected_value = $original_value + 1;

        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);
        $this->get(Router::url(
            ['controller' => 'characters',
                'action' => 'change_stat',
                '_ext' => '.json',
                $char_id, $stat, 1
            ]));
        $this->assertResponseOk();

        $expected = [
            'response' => ['result' => 'success', 'data' => $expected_value],
        ];
        $expected = json_encode($expected, JSON_PRETTY_PRINT);

        $this->assertEquals($expected, $this->_response->body());
        $this->assertEquals($expected_value, $this->viewVariable('response')['data']);
    }

    public function testChangeStatIncreaseFrom1To2()
    {
        $char_id = 1;
        $stat = 'ag';
        $stat_code = 'stat_' . $stat;

        $Characters = TableRegistry::get('Characters');
        $char = $Characters->get($char_id);
        $char->$stat_code = 1;
        $Characters->save($char);

        $original_value = $char->$stat_code;
        $expected_value = $original_value + 1;

        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);
        $this->get(Router::url(
            ['controller' => 'characters',
                'action' => 'change_stat',
                '_ext' => '.json',
                $char_id, $stat, 1
            ]));
        $this->assertResponseOk();

        $expected = [
            'response' => ['result' => 'success', 'data' => $expected_value],
        ];
        $expected = json_encode($expected, JSON_PRETTY_PRINT);

        $this->assertEquals($expected, $this->_response->body());
        $this->assertEquals($expected_value, $this->viewVariable('response')['data']);
    }

    public function testChangeStatDecreaseBelowZeroPrevented()
    {
        $char_id = 1;
        $stat = 'ag';
        $stat_code = 'stat_' . $stat;

        $Characters = TableRegistry::get('Characters');
        $char = $Characters->get($char_id);
        $char->$stat_code = 1;
        $Characters->save($char);

        $expected_value = 0; // cannot go below 0, so expected is still 0.

        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);
        $this->get(Router::url(
            ['controller' => 'characters',
                'action' => 'change_stat',
                '_ext' => '.json',
                $char_id, $stat, -2
            ]));
        $this->assertResponseOk();

        $expected = [
            'response' => ['result' => 'success', 'data' => $expected_value],
        ];
        $expected = json_encode($expected, JSON_PRETTY_PRINT);

        $this->assertEquals($expected, $this->_response->body());
        $this->assertEquals($expected_value, $this->viewVariable('response')['data']);
    }

    public function testChangeSkillIncrease()
    {
        $char_id = 1;
        $skill_id = 1;

        $Skills = TableRegistry::get('Skills');
        $Skill = $Skills
            ->find()
            ->contain([
                'Stats',
                'Training' => function ($q) use ($char_id) {
                    return $q->where(['Training.character_id' => $char_id]);
                }])
            ->where(['Skills.id' => $skill_id])
            ->first();

        $original_value = $Skill->level;
        $expected_value = $original_value + 1;

        $this->get(Router::url(
            ['controller' => 'characters',
                'action' => 'change_skill',
                $char_id, $skill_id, 1
            ]));
        $this->assertResponseOk();
        $this->assertEquals($expected_value, $this->viewVariable('skill')->level);
    }

    public function testChangeSkillDecrease()
    {
        $char_id = 1;
        $skill_id = 2;

        $Skills = TableRegistry::get('Skills');
        $Skill = $Skills
            ->find()
            ->contain([
                'Stats',
                'Training' => function ($q) use ($char_id) {
                    return $q->where(['Training.character_id' => $char_id]);
                }])
            ->where(['Skills.id' => $skill_id])
            ->first();

        $original_value = $Skill->level;
        $expected_value = $original_value - 1;

        $this->get(Router::url(
            ['controller' => 'characters',
                'action' => 'change_skill',
                $char_id, $skill_id, -1
            ]));
        $this->assertResponseOk();
        $this->assertEquals($expected_value, $this->viewVariable('skill')->level);
    }

    public function testAddingTalent()
    {
        $char_id = 1;
        $talent_id = 1;

        $Characters = TableRegistry::get('Characters');
        $C = $Characters
            ->get($char_id, ['contain' => 'Talents']);

        // Clear any existing talents
        $this->assertEquals(0, count($C->talents));

        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);
        $this->get(Router::url(
            ['controller' => 'characters',
                'action' => 'add_talent',
                '_ext' => '.json',
                $char_id, $talent_id
            ]));

        // Confirm basic response is okay
        $this->assertResponseOk();

        // Check Character now contains the talent
        $C = $Characters
            ->get($char_id, ['contain' => 'Talents']);

        $this->assertEquals(1, count($C->talents));
    }

    public function testRemovingTalent()
    {
        $char_id = 1;
        $talent_it = 1;

        $Characters = TableRegistry::get('Characters');
        $C = $Characters
            ->get($char_id, ['contain' => 'Talents']);

        // Clear any existing talents
        $this->assertEquals(0, count($C->talents));

        // First add a talent to later remove
        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);
        $this->get(Router::url(
            ['controller' => 'characters',
                'action' => 'add_talent',
                '_ext' => '.json',
                $char_id, $talent_it
            ]));
        $this->assertResponseOk();

        $C = $Characters
            ->get($char_id, ['contain' => 'Talents']);

        $join_id = $C->talents[0]->_joinData->id;

        // Now remove it
        $this->configRequest([
            'headers' => ['Accept' => 'application/json']
        ]);
        $this->get(Router::url(
            ['controller' => 'characters',
                'action' => 'remove_talent',
                '_ext' => '.json',
                $char_id, $join_id
            ]));
        $this->assertResponseOk();

        $C = $Characters
            ->get($char_id, ['contain' => 'Talents']);

        $this->assertEquals(0, count($C->talents));
    }
}
