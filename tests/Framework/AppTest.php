<?php


namespace Tests\Framework;


use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{

    /**
     * @var App
     */
    private $app;

    public function setUp(): void
    {
        $this->app = new App();
    }

    public function testUriWithoutSlash(): void
    {
        $request = new ServerRequest('GET', '/demo/');
        $response = $this->app->run($request);

        $this->assertContains('/demo', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testBlog(): void
    {
        $request = new ServerRequest('GET', '/blog');
        $response = $this->app->run($request);
        $this->assertStringContainsString("<h1>Welcome on the blog page</h1>", $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test404(): void
    {
        $request = new ServerRequest('GET', '/azerty');
        $response = $this->app->run($request);
        $this->assertStringContainsString("<h1>Not Found 404</h1>", $response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }

}