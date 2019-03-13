<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 13:22
 */
namespace Blankphp\Kernel\Contract;

use Blankphp\Application;
use \Blankphp\Route\Route;

interface Kernel{
    
    public function __construct(Application $app,Route $route);
    public function handle($request);

}