<?php


namespace Blankphp\Scheme;


use Blankphp\Config\Config;
use Blankphp\Database\Database;
use Blankphp\Database\DbConnect;
use Blankphp\Database\Query\Builder;
use mysql_xdevapi\Exception;

class Scheme
{
    protected static $instance;
    protected static $pdo;
    protected $sql;
    protected static $timestamp =[
        'timestamp'=>'timestamp null default null'
    ];

    private function __construct($array, Builder $sql)
    {
        //创建连接
        self::$pdo = DbConnect::pdo($array);
        $this->sql = $sql;
    }


    public static function setInstance($array = [], $sql = null)
    {
        self::$instance = new self($array, $sql);
    }

    public function column($name, array $content = [], $comment = '')
    {
        //拼接sql
        if (isset($content['length']))
            $content['length']='('.$content['length'].')';
        $this->sql->createTable($name,implode(' ',$content),$comment);

    }

    public static function create(\Closure $closure, $name = '')
    {
        //1.获取本身对象，
        echo 'start create '.$name.PHP_EOL;
        try {
            //注入到闭包中
            self::$instance->sql->from($name);
            $closure(self::$instance);
            //生成创建表sql
            //创建

            //记录创建版本
        } catch (\Exception $exception) {
            echo $exception;
        }
        return true;
    }

    public function timestamps()
    {
        //创建时间和修改时间
        $this->sql->createTable('create_at',self::$timestamp['timestamp'],'创建时间');
        $this->sql->createTable('update_at',self::$timestamp['timestamp'],'修改时间');

    }

    public function end(){
        self::$pdo->exec($this->sql->toSql());
        echo "do   ok~~~".PHP_EOL;
    }

    public function bind()
    {

    }

}