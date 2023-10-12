<?php

require 'vendor/autoload.php';

use Dave\HttpServer\StaticServer;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$staticServer = new StaticServer(__DIR__ . '/../docs');
$app->get('/talk/{file}', $staticServer);

return $app;
