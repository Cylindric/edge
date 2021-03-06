<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Utility\Inflector;

class RpgTextHelper extends Helper
{
    public $helpers = ['Html'];

    public function format($text, $data = array())
    {

        if(is_object($data)) {
            $data = (array)($data);
            $data = $data["\0*\0_properties"];
        }

        $char = null;
        if(is_array($data) && array_key_exists('character', $data)) {
            $char = $data['character'];
        }

        // {check.average.medicine}
        $diffs = [
            'easy' => 1,
            'average' => 2,
            'hard' => 3,
            'daunting' => 4,
            'formidable' => 5,
        ];
        $pattern = '{check\.(?P<diff>\w+).(?P<skill>\w+)}';
        $matches = array();
        if(preg_match_all($pattern, $text, $matches)) {
            for($i = 0; $i < count($matches[0]); $i++) {
                $diff = $matches['diff'][$i];
                $skill = $matches['skill'][$i];
                $find = '{'.$matches[0][$i].'}';

                $replace = '<span class="skillcheck">';
                $replace .= Inflector::camelize($diff);
                $replace .= ' (' . $this->dice(['difficulty' => $diffs[$diff]]) . ') ';
                $replace .= Inflector::camelize($skill);
                $replace .= ' check</span>';
                $text = str_replace($find, $replace, $text);
            }
        }

        // {stat.br}
        $pattern = '{stat\.(?P<stat>\w+)}';
        $matches = array();
        if(preg_match_all($pattern, $text, $matches)) {
            for($i = 0; $i < count($matches[0]); $i++) {
                $stat = 'stat_'.$matches['stat'][$i];
                $find = '{'.$matches[0][$i].'}';
                $value = $char->$stat;
                $replace = $value;
                $text = str_replace($find, $replace, $text);
            }
        }

        // {symbol.triumph}
        // {symbol.triumph.rank}
        $pattern = '{symbol\.(?P<symbol>\w+)(\.(?P<multi>\w+))?}';
        $matches = array();
        if(preg_match_all($pattern, $text, $matches)) {
            for($i = 0; $i < count($matches[0]); $i++) {
                $symbol = $matches['symbol'][$i];
                $multi = $matches['multi'][$i] == '' ? 1 : $matches['multi'][$i];
                if($multi == 'rank' && array_key_exists('rank', $data))
                {
                    $multi = $data['rank'];
                }
                $find = '{'.$matches[0][$i].'}';
                $replace = $this->symbol([$symbol => $multi]);
                $text = str_replace($find, $replace, $text);
            }
        }

        // {dice.boost}
        // {dice.boost.rank}
        $pattern = '{dice\.(?P<dice>\w+)(\.(?P<multi>\w+))?}';
        $matches = array();
        if(preg_match_all($pattern, $text, $matches)) {
            for($i = 0; $i < count($matches[0]); $i++) {
                $dice = $matches['dice'][$i];
                $multi = $matches['multi'][$i] == '' ? 1 : $matches['multi'][$i];
                if($multi == 'rank' && array_key_exists('rank', $data))
                {
                    $multi = $data['rank'];
                }
                $find = '{'.$matches[0][$i].'}';
                $replace = $this->dice([$dice => $multi]);
                $text = str_replace($find, $replace, $text);
            }
        }

        // {rank}
        // {rank*number}
        $pattern = '{rank(\*?(?P<multi>\d+))?}';
        $matches = array();
        if(preg_match_all($pattern, $text, $matches)) {
            for($i = 0; $i < count($matches[0]); $i++) {
                $multi = $matches['multi'][$i] == '' ? 1 : $matches['multi'][$i];
                $value = $data['rank'] * $multi;
                $find = '{'.$matches[0][$i].'}';
                $replace = $value;
                $text = str_replace($find, $replace, $text);
            }
        }

        return $text;
    }

    public function dice($dice)
    {
        $out = '';
        if(array_key_exists('proficiency', $dice))
        {
            $out .= str_repeat($this->Html->image('dice-proficiency.png', ['alt' => 'Proficiency Dice']), $dice['proficiency']);
        }
        if(array_key_exists('ability', $dice))
        {
            $out .= str_repeat($this->Html->image('dice-ability.png', ['alt' => 'Ability Dice']), $dice['ability']);
        }
        if(array_key_exists('difficulty', $dice))
        {
            $out .= str_repeat($this->Html->image('dice-difficulty.png', ['alt' => 'Difficulty Dice']), $dice['difficulty']);
        }
        if(array_key_exists('boost', $dice))
        {
            $out .= str_repeat($this->Html->image('dice-boost.png', ['alt' => 'Boost Dice']), $dice['boost']);
        }
        if(array_key_exists('setback', $dice))
        {
            $out .= str_repeat($this->Html->image('dice-setback.png', ['alt' => 'Setback Dice']), $dice['setback']);
        }
        return $out;
    }

    public function symbol($symbols)
    {
        $out = '';
        if(array_key_exists('success', $symbols))
        {
            $out .= str_repeat($this->Html->image('symbol-success.png', ['alt' => 'Success']), $symbols['success']);
        }
        if(array_key_exists('triumph', $symbols))
        {
            $out .= str_repeat($this->Html->image('symbol-triumph.png', ['alt' => 'Triumph']), $symbols['triumph']);
        }
        return $out;
    }
}
