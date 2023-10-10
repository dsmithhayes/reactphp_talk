<?php

/**
 * The `app.php` is a simple Slim Application that will bootstrap a database and set up the routes for the talk itself
 * and some other examples.
 */

require 'vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function (Request $req, Response $res) {
    $data = [ 'message' => 'Hello!' ];
    $res->getBody()->write(json_encode($data));
    return $res->withHeader('Content-Type', 'application/json');
});

$app->get('/talk/{file}', function (Request $req, Response $res, array $args) {
    $static_path = __DIR__ . '/../docs';
    $dir_contents = scandir($static_path);

    foreach ($dir_contents as $file) {
        if ($file === $args['file']) {
            $full_path = $static_path . '/' . $file;

            // get extension, assume content type
            $content_type = match (pathinfo($file, PATHINFO_EXTENSION)) {
                'jpg' => 'image/jpg',
                default => 'text/html',
            };

            printf("Serving: %s\n", $file);
            $file_contents = file_get_contents($full_path);
            $res->getBody()->write($file_contents);

            return $res->withHeader('Content-Type', $content_type);
        }
    }

    throw new Exception("Unable to find file: " . $args['file']);
});

return $app;
