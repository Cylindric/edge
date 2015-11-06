
<?php
use Cake\Routing\Router;

Router::plugin('OnlineAuth', function ($routes) {

    $routes->connect(
        '/xxendpoint',
        ['controller' => 'OnlineAuth', 'action' => 'endpoint']
    );

});
