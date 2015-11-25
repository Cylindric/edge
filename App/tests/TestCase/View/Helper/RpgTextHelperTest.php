<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\RpgTextHelper;
//use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class RpgTextHelperTest extends TestCase
{
    public $fixtures = ['app.characters'];

    public function setUp()
    {
        parent::setUp();
        $View = new View();
        $this->RpgText = new RpgTextHelper($View);
//        $this->Characters = TableRegistry::get('Characters');
    }

    public function testParserSkillCheckDifficulties()
    {
        //{check.easy.medicine}
        $result = $this->RpgText->format('test {check.easy.medicine} text');
        $dice = $this->RpgText->dice(['difficulty' => 1]);
        $this->assertEquals('test <span class="skillcheck">Easy ('.$dice.') Medicine check</span> text', $result);

        //{check.average.medicine}
        $result = $this->RpgText->format('test {check.average.medicine} text');
        $dice = $this->RpgText->dice(['difficulty' => 2]);
        $this->assertEquals('test <span class="skillcheck">Average ('.$dice.') Medicine check</span> text', $result);

        //{check.hard.medicine}
        $result = $this->RpgText->format('test {check.hard.medicine} text');
        $dice = $this->RpgText->dice(['difficulty' => 3]);
        $this->assertEquals('test <span class="skillcheck">Hard ('.$dice.') Medicine check</span> text', $result);

        //{check.daunting.medicine}
        $result = $this->RpgText->format('test {check.daunting.medicine} text');
        $dice = $this->RpgText->dice(['difficulty' => 4]);
        $this->assertEquals('test <span class="skillcheck">Daunting ('.$dice.') Medicine check</span> text', $result);

        //{check.formidable.medicine}
        $result = $this->RpgText->format('test {check.formidable.medicine} text');
        $dice = $this->RpgText->dice(['difficulty' => 5]);
        $this->assertEquals('test <span class="skillcheck">Formidable ('.$dice.') Medicine check</span> text', $result);
    }

    public function testParserStats()
    {
        $char = (object) ['stat_br' => 4, 'stat_ag' => 3];
        $data = ['character' => $char];

        // {stat.br}
        $result = $this->RpgText->format('test {stat.br} text', $data);
        $this->assertEquals('test 4 text', $result);

        // {stat.ag}
        $result = $this->RpgText->format('test {stat.ag} text', $data);
        $this->assertEquals('test 3 text', $result);

        // multiple
        $result = $this->RpgText->format('test {stat.ag} and {stat.br} text', $data);
        $this->assertEquals('test 3 and 4 text', $result);
    }

    public function testParserStatsWithObject()
    {
        $char = (object) ['stat_br' => 4, 'stat_ag' => 3];
        $data = (object) ["\0*\0_properties" => ['character' => $char]]; // the odd key is to simulate the (array) cast with private properties
        $result = $this->RpgText->format('test {stat.br} text', $data);
        $this->assertEquals('test 4 text', $result);
    }

    public function testParserSymbols()
    {
        // Single Triumph
        $result = $this->RpgText->format('test {symbol.triumph} text');
        $dice = $this->RpgText->symbol(['triumph' => 1]);
        $this->assertEquals('test '.$dice.' text', $result);

        // Multiple Triumph
        for($i = 0; $i < 3; $i++)
        {
            $result = $this->RpgText->format('test {symbol.triumph.'.$i.'} text');
            $dice = $this->RpgText->symbol(['triumph' => $i]);
            $this->assertEquals('test ' . $dice . ' text', $result);
        }
    }

    public function testParserSymbolsMultiRank()
    {
        $data = ['rank' => 2];
        $result = $this->RpgText->format('test {symbol.triumph.rank} text', $data);
        $dice = $this->RpgText->symbol(['triumph' => $data['rank']]);
        $this->assertEquals('test ' . $dice . ' text', $result);
    }

    public function testParserDice()
    {
        // Single Boost
        $result = $this->RpgText->format('test {dice.boost} text');
        $dice = $this->RpgText->dice(['boost' => 1]);
        $this->assertEquals('test '.$dice.' text', $result);

        // Multiple Boost
        for($i = 0; $i < 3; $i++)
        {
            $result = $this->RpgText->format('test {dice.boost.'.$i.'} text');
            $dice = $this->RpgText->dice(['boost' => $i]);
            $this->assertEquals('test ' . $dice . ' text', $result);
        }
    }

    public function testParserDiceMultiRank()
    {
        $data = ['rank' => 2];
        $result = $this->RpgText->format('test {dice.boost.rank} text', $data);
        $dice = $this->RpgText->dice(['boost' => $data['rank']]);
        $this->assertEquals('test ' . $dice . ' text', $result);
    }

    public function testParserRank()
    {
        $data = ['rank' => 3];
        $result = $this->RpgText->format('test {rank} text', $data);
        $this->assertEquals('test 3 text', $result);
    }

    public function testParserRankWithMultiplier()
    {
        $data = ['rank' => 3];
        $result = $this->RpgText->format('test {rank*10} text', $data);
        $this->assertEquals('test 30 text', $result);
    }

    public function testDice()
    {
        $result = $this->RpgText->dice(['proficiency' => 1]);
        $this->assertEquals('<img src="/img/dice-proficiency.png" alt="Proficiency Dice"/>', $result);

        $result = $this->RpgText->dice(['ability' => 1]);
        $this->assertEquals('<img src="/img/dice-ability.png" alt="Ability Dice"/>', $result);

        $result = $this->RpgText->dice(['difficulty' => 1]);
        $this->assertEquals('<img src="/img/dice-difficulty.png" alt="Difficulty Dice"/>', $result);

        $result = $this->RpgText->dice(['boost' => 1]);
        $this->assertEquals('<img src="/img/dice-boost.png" alt="Boost Dice"/>', $result);
    }

    public function testDicePutsProficiencyBeforeAbility()
    {
        $result = $this->RpgText->dice(['ability' => 1, 'proficiency' => 1]);
        $this->assertEquals('<img src="/img/dice-proficiency.png" alt="Proficiency Dice"/><img src="/img/dice-ability.png" alt="Ability Dice"/>', $result);
    }

    public function testSymbols()
    {
        $result = $this->RpgText->symbol(['triumph' => 1]);
        $this->assertEquals('<img src="/img/symbol-triumph.png" alt="Triumph"/>', $result);

        $result = $this->RpgText->symbol(['success' => 1]);
        $this->assertEquals('<img src="/img/symbol-success.png" alt="Success"/>', $result);
    }
}
