<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 19:58
 */

namespace App\Controllers;


use Blankphp\Cookie\Facade\Cookie;
use Blankphp\Database\Facade\DB;
use Blankphp\Request\Request;

class PagesController extends Controller
{
    public function index(Request $request)
    {

//        var_dump(DB::table('teacher')->delete(['name','=','test']));
        return '<style type="text/css">
                *{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; }
                 body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; }
                  p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> 
                <h1>:)</h1><p> BlankPhp V1<br/><span style="font-size:30px">十年磨一剑 - 为phpWeb开发设计的高性能框架</span></p><span style="font-size:22px;">
                [ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]
                </span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8">
                </script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><blankPhp id="dadad12596"></blankPhp>';
    }

    public function indx()
    {
        return 'this is a test';
    }

    public function get()
    {
        echo "a1sda5w1";
    }

    public function getone($id)
    {
        $student = DB::table('students')->where('id', '=', $id)->orWhere('id', '=', 2)->get();
        return view('stu', ['student' => $student]);
    }

}