<?php


namespace Blankphp\Cache;


class FileCache
{
    public static $key;
    public static $dir = APP_PATH . 'cache/framework/';
    protected static $cacheTime = 0;

    public static function get($file)
    {
        //获取缓存
        if (is_file(self::$dir . $file))
            return include (self::$dir . $file);
    }


    public static function putCache($data, $file)
    {
        $text = '<?php return ' . var_export($data, true) . ';';
        file_put_contents(self::$dir . $file, $text);
    }

    public static function canRebuild($file, $descFile)
    {
        return filemtime($file) - filemtime(self::$dir . $descFile) < self::$cacheTime;
    }


}