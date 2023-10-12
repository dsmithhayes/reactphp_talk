<?php

require_once 'vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$random_number = rand(0, 10);
$app->post('/random/guess/{number}', function (Request $req, Response $res, array $args) use ($random_number) {
    $res = $res->withHeader('Content-Type', 'application/json');
    $guess = $args['number'];

    if ($guess == $random_number) {
        $data = [ 'success' => true ];
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('X-Success', 'true');
    }

    $data = [ 'success' => false ];
    $res->getBody()->write(json_encode($data));
    return $res
        ->withStatus(400)
        ->withHeader('X-Success', 'false');
});

$app->get('/random/number', function (Request $req, Response $res) use ($random_number) {
    $data = [ 'number' => $random_number ];
    $res->getBody()->write(json_encode($data));
    return $res->withHeader('Content-Type', 'application/json');
});

return $app;
