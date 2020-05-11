<?php


namespace Framework;


use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class App
{
    public function run(RequestInterface $request): ResponseInterface
    {
        $uri      = $request->getUri()->getPath();
        $response = new Response();
        if ($uri !== null && $uri[-1] === "/") {
            return $response->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }
        if ($uri === "/blog") {
            return new Response(200, [], "<h1>Welcome on the blog page</h1>");
        }

        return new Response(404, [], "<h1>Not Found 404</h1>");
    }
}
