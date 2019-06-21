<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/17
 * Time: 15:32
 */

namespace Blankphp\Session;


use Blankphp\Application;
use Blankphp\Contract\Session as SessionContract;
use Blankphp\Cookie\Facade\Cookie;

class Session implements SessionContract
{
    protected static $sessionName = 'BlankPhp';

    public function __construct(Application $app)
    {
        $config = config('app.session');
        if (isset($config['expire'])){
            session_cache_expire($config['expire']);
        }
        if (isset($config['path'])){
            session_save_path($config['path']);
        }
        if (isset($config['name'])){
            session_name($config['name']);
            self::$sessionName=$config['name'];
        }else{
            session_name(self::$sessionName);
        }
        if (isset($config['driver'])){
//            设置session存储方式
        }
        $app->instance('session',$this);
    }

    public function start(){
            session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function destroy()
    {
        $_SESSION = [];
        $paramers = session_get_cookie_params();
        Cookie::set(self::$sessionName, '', time() - 1,$paramers);
        session_destroy();
    }

    public function get($name)
    {
        var_dump($_SESSION);
        return isset($_SESSION[$name])?$_SESSION[$name]:[];
    }

}