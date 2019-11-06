<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 19:58
 */

namespace App\Controllers;

use App\Models\User;
use \Blankphp\Contract\Request;
use \Blankphp\Facade\Cache;
use \Blankphp\Facade\DB;
use \Blankphp\Facade\Session;
use \Blankphp\Facade\Log;


class QqController extends Controller
{
    public function index(Request $request)
    {
        Log::info('test',$request->request['input']);
    }

////
//    public function getone($id)
//    {
//        var_dump($id);
////        $student = DB::table('users')->create(['id'=>'default','sid'=>'ddd','name'=>'wudi22','sex'=>'男','tel'=>'']);
//        $student = DB::table('users')->where('id', '=', '30')->get();
//        $student = DB::table('users')->where('id', '=', '30')->delete();
//        $student = DB::table('users')->where('id', '=', '31')->update(['name' => 'hahah']);
////        return view('stu', ['student' => $student]);
//        var_dump($student);
//    }
}