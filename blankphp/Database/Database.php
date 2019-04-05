<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/18
 * Time: 14:52
 */

namespace Blankphp\Database;


use Blankphp\Application;
use Blankphp\Contract\Container;

class Database
{
    public function __construct(Application $app)
    {
        $db = $app->getSignal('config')['db'];
    }

}