<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/17
 * Time: 15:32
 */

namespace Blankphp\Session;


use Blankphp\Contract\Session as SessionContract;
use Blankphp\Cookie\Facade\Cookie;

class Session implements SessionContract
{
    protected $sessionName = 'BlankPhp';

    public function __construct()
    {
        $name = config('app')['session']['driver'];

    }

    public function setSessionName($name=null){
        if (is_null($name)){
            session_name($name);
        }else{
            session_name($this->sessionName);
        }
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function start()
    {
        if (is_null($_SESSION))
            session_start();
    }

    public function destroy()
    {
        $_SESSION = [];
        $paramers = session_get_cookie_params();
        Cookie::set(session_name(), '', time() - 1, ...$paramers);
        session_destroy();
    }

    public function get($name)
    {
        return $_SESSION[$name];
    }

}