<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/10
 * Time: 21:33
 */

namespace Blankphp\Contract;


interface Request
{
    public function get($name = '', array $optionm = []);
    public function getUri();
    public function getMethod();
    public function file($name = '');
    public function getUserAgent();
    public function userIp();
    public function getLanguage();
}