<?php

use League\Route\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/bootstrap.php';

$strategy = (new League\Route\Strategy\ApplicationStrategy)->setContainer($container);


$router = new Router;
$router->setStrategy($strategy);

require_once __DIR__ . '/../config/routes.php';

$response = $router->dispatch(new \App\Http\Request());

foreach ($response->getHeaders() as $name => $value) {
    header($name . ': ' . $value);
}
echo $response->getBody();
