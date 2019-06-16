<?php


namespace Blankphp\Exception;


use Blankphp\Application;

class Error
{
    protected static $handler;
    protected $app;
    public function bootstrap(Application $app)
    {
        $this->app= $app;
        error_reporting(E_ALL);
        set_error_handler([__CLASS__, 'Error']);
        set_exception_handler([__CLASS__, 'Exception']);
        register_shutdown_function([__CLASS__, 'Shutdown']);
    }

    public static function Exception($e){
        $handler =self::getHandler();
        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) == 'cli') {
            $handler->handToConsole($e);
        } else {
            $handler->handToRender($e);
        }
    }

    public static function Error(){

    }

    public static function Shutdown(){

    }

    public static function getHandler(){
        if (empty(self::$handler)){
            //创建一个新的handler
            //获取一个handler
            $class=config('app.exception_handler');
            self::$handler=$handler = new $class();
        }
        return self::$handler;
    }


}