<?php


namespace Blankphp\Cache;


use Blankphp\Application;
use Blankphp\Cache\Contract\Driver;

abstract class CacheAbstract
{
    // driver的句柄
    private $handler = null;
    //保存文件或者写入读取
    private $file;
    //获取到的数据
    private $data=[];
    //写入次数
    private $writeCount=0;
    //读取次数
    private $getCount=0;
    //保存的路径
    protected static $dir;
    protected $tag;

    public function __construct(Application $app)
    {
        $handler = config('app.cache.driver');
        $this->setHandler(new $handler);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getWriteCount()
    {
        return $this->writeCount;
    }

    /**
     * @param int $writeCount
     */
    public function setWriteCount($writeCount)
    {
        $this->writeCount = $writeCount;
    }

    /**
     * @return int
     */
    public function getGetCount()
    {
        return $this->getCount;
    }

    /**
     * @param int $getCount
     */
    public function setGetCount($getCount)
    {
        $this->getCount = $getCount;
    }


    /**
     * @return null
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param Driver $handler
     */
    public function setHandler(Driver $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }


    public function set($key, $value, $ttl=null ){
        return $this->handler->set($key, $value, $ttl );
    }

     public function get($key, $default){
         return $this->handler->get($key, $default );
     }

    public function remember($array,\Closure $closure){
        return $this->handler->remember($array, $closure);
    }

    public function has($key){
        return $this->handler->has($key);
    }

}