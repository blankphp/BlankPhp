<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/12
 * Time: 10:12
 */

namespace Blankphp\Provider\Contract;


use Blankphp\Application;

interface ProviderContract
{
    public function __construct();
    public function boot();
    public function register();
}