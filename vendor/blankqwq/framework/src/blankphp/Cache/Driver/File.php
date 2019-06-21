<?php


namespace Blankphp\Cache\Driver;


use Blankphp\Cache\Contract\Driver;

class File implements Driver
{
    public static $key;
    protected static $cacheTime = 0;

    public function __construct()
    {
    }

    public  function file($file)
    {
        //获取缓存
        if (is_file(self::$dir . $file))
            return include (self::$dir . $file);
    }


    public  function putCache($data, $file)
    {
        $text = '<?php return ' . var_export($data, true) . ';';
        file_put_contents(self::$dir . $file, $text);
    }

    public  function canRebuild($file, $descFile)
    {
        return filemtime($file) - filemtime(self::$dir . $descFile) < self::$cacheTime;
    }

    public function build(){


    }

    public function set($key, $value, $ttl = null)
    {
        // TODO: Implement set() method.
    }

    public function remember($array, \Closure $closure)
    {
        // TODO: Implement remember() method.
    }

    public function has($key)
    {
        // TODO: Implement has() method.
    }

    public function get($key, $default)
    {
        // TODO: Implement get() method.
    }
}