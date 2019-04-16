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
        $last_id =1 ;
        if ($last_id)
            $array = ['name' => ['url' => 'http://localhost/one/public/static/images/BlankPhp.png', 'name' => 'blankqwq', 'message' => '插入成功']];
        else
            $array = ['name' => ['url' =>asset('images/BlankPhp.png'), 'name' => 'blankqwq', 'message' => '插入失败'.$last_id]];
        return view('index', $array);
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