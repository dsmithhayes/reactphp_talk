<?php

require_once './vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use React\Http\HttpServer;
use React\Http\Message\Response as HttpResponse;
use React\Socket\SocketServer;

$server = new HttpServer(function (Request $request) {
    $userAgent = $request->getHeaderLine('User-Agent');
    printf("Call from Client: %s\n", $userAgent);
    return HttpResponse::plaintext("Hello!\n");
});

$socket = new SocketServer('127.0.0.1:8080');
$server->listen($socket);

printf("Listening on 8080\n");
