<?php

require 'vendor/autoload.php';

use Dave\HttpServer\HttpServerWrapper;
use Dave\HttpServer\StaticServer;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$staticServer = new StaticServer(__DIR__ . '/../docs');
$app->get('/talk/{file}', $staticServer);

$server = new HttpServerWrapper($app, '127.0.0.1', 8081);
$server->run();
