<?php

namespace Dave\HttpServer;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class StaticServer
{
    private string $dir;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    public function __invoke(Request $req, Response $res, array $args): Response
    {
        foreach (scandir($this->dir) as $file) {
            if ($file === $args['file']) {
                $full_path = $this->dir . '/' . $file;

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

        $res->getBody()->write("Unable to find file: {$args['file']}");
        return $res->withStatus(404);
    }
}
