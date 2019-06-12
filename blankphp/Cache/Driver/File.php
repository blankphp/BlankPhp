<?php


namespace Blankphp\Cache\Driver;


class File
{
    public static $key;
    public static $dir = APP_PATH . 'cache/framework/';
    protected static $cacheTime = 0;
    public function __construct()
    {
    }

    public  function get($file)
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

}