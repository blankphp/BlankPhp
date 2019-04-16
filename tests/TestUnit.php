<?php

use PHPUnit\Framework\TestCase;

class TestUnit extends TestCase
{
    protected $app;

    public function createApplication()
    {
        define('APP_PATH', __DIR__ . '/../');
        $app = require __DIR__ . '/../blankphp/Application.php';

        $app->make(\Blankphp\Contract\Kernel::class)->bootstrap();

        return $this->app = $app;
    }

    public function testBasicTest()
    {
        $response = $this->get('/11');
        $this->assertEquals('this is a test', $response);
    }

    public function get($uri)
    {
        return $this->call('GET', $uri, [], [], []);
    }


    public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        $this->createApplication();
        $kernel = $this->app->make(\Blankphp\Contract\Kernel::class);
        define('APP_ENV', 'testing');

        $response = $kernel->handle(
            \Blankphp\Request\TestRequest::create($method, $uri, $parameters, $cookies,
                $files, $server, $content)
        );
        return $response->returnSend();
    }

}