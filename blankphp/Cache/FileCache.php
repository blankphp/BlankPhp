<?php


namespace Blankphp\Cache;


class FileCache
{
    public static $key;
    public static $dir = APP_PATH . 'cache/framework/';

    public static function get($file)
    {
        //获取缓存
        if (is_file(self::$dir . $file))
             return require self::$dir . $file;
    }


    public static function putCache($data, $file)
    {
        $text = '<?php return ' . var_export($data, true) . ';';
        file_put_contents(self::$dir . $file, $text);
    }


}