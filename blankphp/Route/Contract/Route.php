<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 21:33
 */

namespace Blankphp\Route\Contract;


use Blankphp\Facade\Application;

interface Route
{
    public function __construct(Application $app);

}