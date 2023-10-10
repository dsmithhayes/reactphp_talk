<?php

require 'vendor/autoload.php';

use Dave\ReactDemo\ConnectionPoolConfiguration;
use Dave\ReactDemo\PdoConnectionPool;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$databases = new PdoConnectionPool(
    ConnectionPoolConfiguration::fromArray([
        'host' => '127.0.0.1',
        'database' => 'somedatabase',
        'user' => 'someuser',
        'password' => 'Password1!',
    ])
);

$app->get('/', function (Request $req, Response $res) {
    $data = [ 'message' => 'Hello!' ];
    $res->getBody()->write(json_encode($data));
    return $res->withHeader('Content-Type', 'application/json');
});

$app->post('/test', function (Request $req, Response $res) use ($databases) {
    $body = $req->getParsedBody();

    $query = "INSERT INTO test_table (str, num) VALUES (:str, :num)";
    /** @var PDO $connection */
    $connection = $databases->getConnection();

    $statement = $connection->prepare($query, [
        ':str' => $body['str'],
        ':num' => $body['num'],
    ]);

    $result = $statement->execute();
    $res->getBody()->write(json_encode([ 'result' => $result ]));
    return $res->withHeader('Content-Type', 'application.json')->withStatus(201);
});

return $app;
