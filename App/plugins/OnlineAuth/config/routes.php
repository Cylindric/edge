<?php
use Cake\Routing\Router;

Router::plugin('OnlineAuth', function ($routes) {
    $routes->fallbacks('DashedRoute');
});
