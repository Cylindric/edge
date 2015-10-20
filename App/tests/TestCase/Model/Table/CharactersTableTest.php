<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CharactersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class CharactersTableTest extends TestCase
{
    public $fixtures = ['app.characters'];

    public function setUp()
    {
        parent::setUp();
        $this->Characters = TableRegistry::get('Characters');
    }

    public function testIsOwnedBy()
    {
//        $query = $this->Characters->find('published');
//        $this->assertInstanceOf('Cake\ORM\Query', $query);
//        $result = $query->hydrate(false)->toArray();
//        $expected = [
//            ['id' => 1, 'title' => 'First Article'],
//            ['id' => 2, 'title' => 'Second Article'],
//            ['id' => 3, 'title' => 'Third Article']
//        ];
//
//        $this->assertEquals($expected, $result);
    }
}