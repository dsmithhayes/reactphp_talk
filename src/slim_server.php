<?php

require_once 'vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use React\Http\HttpServer;
use React\Socket\SocketServer;

$app = require 'app.php';

$server = new HttpServer(function (Request $request) use ($app) {
    return $app->handle($request);
});

$server->on('error', function (\Exception $e) {
    printf($e->getMessage() . "\n");
    printf($e->getTraceAsString());
});

$socket = new SocketServer('127.0.0.1:8080');
$server->listen($socket);

printf("Listening on 8080\n");
