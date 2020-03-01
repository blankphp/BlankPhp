<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 19:58
 */

namespace App\Controllers;

use App\Lib\CoolQ;
use App\Lib\CQ;
use App\Lib\HttpCurl;
use App\Models\User;
use \Blankphp\Contract\Request;
use Blankphp\Facade\Cache;
use \Blankphp\Facade\DB;
use \Blankphp\Facade\Session;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        return '<style type="text/css">
                *{ padding: 0; margin: 0;text-align: center }
                 body{
                  font-family: Helvetica, "Microsoft YaHei", Arial, sans-serif;
                    font-size: 14px;
                 color: #333}
                  h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; }
                  p{ line-height: 2em; font-size: 45px }</style>
                  <div style="padding: 50px;">
                <h1>🚀</h1><p> BlankPhp V1<br/><span style="font-size:30px">每日练习，刻意精进 <br>
                为phpWeb开发设计的高性能框架</span>
                </p><span style="font-size:22px;">
                </span></div></script>
                <blankPhp id="dadad12596"></blankPhp>';
    }


}