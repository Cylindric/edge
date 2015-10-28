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
        if(array_key_exists('character', $data)) {
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
        // {symbol.triumph.multi}
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
        // {dice.boost.multi}
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
        if(strpos($text, '{rank}') !== false && array_key_exists('rank', $data)) {
            $text = str_replace('{rank}', $data['rank'], $text);
        }

        return $text;
    }

    public function dice($dice)
    {
        $out = '';
        if(array_key_exists('proficiency', $dice))
        {
            $out .= str_repeat($this->Html->image('dice-proficiency.png'), $dice['proficiency']);
        }
        if(array_key_exists('ability', $dice))
        {
            $out .= str_repeat($this->Html->image('dice-ability.png'), $dice['ability']);
        }
        if(array_key_exists('difficulty', $dice))
        {
            $out .= str_repeat($this->Html->image('dice-difficulty.png'), $dice['difficulty']);
        }
        if(array_key_exists('boost', $dice))
        {
            $out .= str_repeat($this->Html->image('dice-boost.png'), $dice['boost']);
        }
        return $out;
    }

    public function symbol($symbols)
    {
        $out = '';
        if(array_key_exists('success', $symbols))
        {
            $out .= str_repeat($this->Html->image('symbol-success.png'), $symbols['success']);
        }
        if(array_key_exists('triumph', $symbols))
        {
            $out .= str_repeat($this->Html->image('symbol-triumph.png'), $symbols['triumph']);
        }
        return $out;
    }
}
