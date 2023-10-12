<?php

namespace Dave\HttpServer;

use Psr\Http\Message\ServerRequestInterface as Request;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use Slim\App;

class HttpServerWrapper
{
    public function __construct(
        private readonly App    $app,
        private readonly string $host = '127.0.0.1',
        private readonly int    $port = 80
    ) { }

    public function run(): void
    {
        $app = $this->app;
        $server = new HttpServer(function (Request $request) use ($app) {
            return $app->handle($request);
        });

        $server->on('error', function (\Exception $e) {
            printf($e->getMessage() . "\n");
            printf($e->getTraceAsString());
        });

        $uri = $this->host . $this->port;
        $socket = new SocketServer($uri);
        $server->listen($socket);

        printf("Listening on 8080\n");
    }
}
