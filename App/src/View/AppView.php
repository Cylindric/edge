<?php
namespace App\View;

use Cake\View\View;

class AppView extends View
{
    public function initialize()
    {
        $this->loadHelper('RpgText');
        $this->loadHelper('Form', [
            'templates' => 'app_form',
        ]);
    }
}
