<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 11:24
 */

namespace Blankphp\Model;


use Blankphp\Database\Database;
use Blankphp\Database\Query\Builder;
use Blankphp\Event\EventAbstract;
use \Blankphp\Database\Collection;
use Blankphp\Model\Traits\belongsTo;
use Blankphp\Model\Traits\belongsToMany;
use Blankphp\Model\Traits\hasMany;
use Blankphp\Model\Traits\hasOne;

class Model extends EventAbstract
{
    use belongsTo, belongsToMany, hasMany, hasOne;
    protected $database;
    protected $tableName;
    protected $primaryKey;
    protected $fillable = [];
    //原来的数据
    protected $origin = [];
    //真实数据
    protected $data = [];
    protected $collection;
    //sql
    protected $sql;
    protected $status;


    public function __construct($id = 0)
    {
        //获取属性连接DB只是工具类
        //废弃的字段
        $this->makeQuery();
        $this->database->table($this->tableName);
        $this->collection = new Collection();
        if ($id > 0)
            $this->collection = $this->find($id);
        //设定好对应关系以及
    }

    public function __get($name)
    {
        return $this->collection->{$name};
    }

    public function makeQuery()
    {
        if (empty($this->database)) {
            $driver = config('db.default');
            $grammer_class = 'Blankphp\\Database\\Grammar\\' . ucwords(strtolower($driver)) . 'Grammar';
            $grammer = new $grammer_class;
            $builder = new Builder($grammer);
            return $this->database = new Database($builder);
        }
    }

    public function save()
    {
        if ($this->status = 'new') {
            $this->event('saving');
            //可填充字段获取到，其他剔除
            $this->data['id'] = 'default';
            $result = $this->database->create($this->data);
            $this->event('saved');
            return $this->data = $this->collection;
        } else {
            return $this->updateOne($this->data);
        }
    }


    public function __set($name, $value)
    {
        //设定一些未设定的属性
        $this->data[$name] = $value;
    }


    private function updateOne()
    {
        $this->event('updating');
        $result = $this->database->update($this->data);
        $this->event('updated');
        return $result;
    }

    public static function __callStatic($name, $arguments)
    {
        return (new static())->{$name}(...$arguments);
    }

    //查询语句的核心--以及获取数据
    public function __call($name, $arguments)
    {
        return $this->database->{$name}(...$arguments);
    }

    //预加载
    public function with(){
        $args = func_get_args();

    }

}