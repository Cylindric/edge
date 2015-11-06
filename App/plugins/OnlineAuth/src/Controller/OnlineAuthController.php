<?php
namespace OnlineAuth\Controller;

use OnlineAuth\Controller\AppController;

class OnlineAuthController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $test='tet';
    }

    public function endpoint()
    {
        $this->set('blah', null);
    }

    public function authorize()
    {

    }
}