<?php

use PHPUnit\Framework\TestCase;

class TestUnit extends TestCase
{
    protected $app;

    public function createApplication()
    {
        define('APP_PATH', dirname(__DIR__));
        $app = \Blankphp\Application::init();
        $app->make(\Blankphp\Contract\Kernel::class);
        return $this->app = $app;
    }

    public function testBasicTest()
    {
        $response = $this->get('/');
        $res = '<style type="text/css">
                *{ padding: 0; margin: 0;text-align: center }
                 body{
                  font-family: Helvetica, "Microsoft YaHei", Arial, sans-serif;
                    font-size: 14px;
                 color: #333}
                  h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; }
                  p{ line-height: 2em; font-size: 45px }</style>
                  <div style="padding: 50px;">
                <h1>🚀</h1><p> BlankPhp V1<br/><span style="font-size:30px">每日练习，刻意精进 <br>
                为phpWeb开发设计的高性能框架</span>
                </p><span style="font-size:22px;">
                </span></div></script>
                <blankPhp id="dadad12596"></blankPhp>';
        $this->assertEquals($res, $response);
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