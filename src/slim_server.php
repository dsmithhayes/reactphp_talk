<?php

require_once 'vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use React\Http\HttpServer;
use React\Socket\SocketServer;

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function (Request $req, Response $res) {
    $data = [ 'message' => 'Hello!' ];
    $res->getBody()->write(json_encode($data));
    return $res->withHeader('Content-Type', 'application/json');
});

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
