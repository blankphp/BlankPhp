<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/11
 * Time: 19:58
 */

namespace App\Controllers;

use App\Event\RandomEvent;
use App\Event\RepeaterEvent;
use App\Lib\CoolQ;
use App\Models\Message;
use App\Models\User;
use \Blankphp\Contract\Request;
use \Blankphp\Facade\Cache;
use \Blankphp\Facade\DB;
use \Blankphp\Facade\Session;
use \Blankphp\Facade\Log;


class QqController extends Controller
{
    /**
     * @var array
     * 动作对应表
     */
    public $action = [
        '开启真心话大冒险' => 'ReAction',
        '签到' => 'SignAction',
        '查询' => 'SearchAction',
        '日常' => 'DailyAction',
        '看帅哥' => '',
        '看美女' => '',
        '金价' => 'MoneyAction',
        '文库' => 'WenkuAction',
        '骚话' => 'SaoAction',
        '转接' => 'JoinGroupAction',
        '赞我' => 'SendLikeAction',
        '点赞' => 'SendLikeAction',
        '导入' => 'ImportAction',
        '删除' => 'DeleteAction',
        '晚安' => 'NightAction',
        '发送' => 'SendAction',
        '闭嘴' => 'CloseOneAction',
        '说话啊' => 'OpenOneAction',
        '撸猫教程' => 'EduAction',
        '使用教程' => 'EduAction',
        'help' => 'EduAction',
        '成就' => 'AchievementAction',
        '宏' => 'HongAction',
        '结束' => 'EndJoinAction',
        '群列表' => 'GroupListAction',
        '退出' => 'QuitAction',
        '物品' => 'GoodsAction',
        '背包' => 'GoodsAction',
        '物价' => 'QueryGoodsAction',
        '故事' => 'QueryStoryAction',
        '吃瓜' => 'QueryStoryAction',
        '八卦' => 'QueryStoryAction',
        '群设置' => 'GroupSetAction',
        '设置' => 'UserSetAction',
        '看号' => 'QueryAccountAction'

    ];


    public $event = [
        //复读机event
        'RepeaterEvent',
        //智能词库
        'ThesaurusEvent',
        //骚话事件
        'SaoHuaEvent',
        //随机事件
        'RandomEvent'
    ];
    /**
     * @var array
     * 管理员账户
     */
    protected $admin = [
        '1136589038'
    ];


    public function index(Request $request)
    {
//        Log::info('message', $request->request['input']);
        if ($request->get('post_type') == 'message') {
            $cool = new CoolQ('192.168.1.170:5700');
            $sender = $request->get('sender');
            $time = date('Y-m-d H:i:s', time());
            $message = $request->get('message');
            if (!empty($request->get('group_id'))) {
                $group_id = $request->get('group_id');
                $message_type = $request->get('message_type');
            } else {
                $group_id = $request->get('user_id');
                $message_type = "private";
            }
            if (!empty($forward = Cache::get('forward')) && $forward == $group_id) {
                $name = !empty($sender['card']) ? $sender['card'] : $sender['nickname'];
                $cool->sendPrivateMsg('1136589038', $name . "：\r\n" . $message);
            }

            $command = preg_split('#\s{1,10}#', $message, 2);
            $command = array_filter($command);
            if (in_array(trim($command[0]), array_keys($this->action))) {
                //调用对应Action
                $action = "App\Action\\" . $this->action[$command[0]];
                $class = new $action($cool);
                Log::info('command:', $command);
                $args = isset($command[1]) ? $command[1] : '';
                $class->handle($args, $group_id, $message_type, $sender);
                return;
            }
            if ($message != '结束' && $sender['user_id'] == '1136589038' && $message_type == 'private' && !empty($forward = Cache::get('forward'))) {
                $cool->sendGroupMsg($forward, $message);
                $cool->sendPrivateMsg('1136589038', "发送成功：\r\n" . $message);
            }
            $res = DB::table('messages')->create(
                [
                    'message_type' => $message_type
                    , 'content' => $message
                    , 'qq' => $sender['user_id']
                    , 'group_id' => $group_id
                    , 'create_at' => date('Y-m-d H:i:s', time())
                    , 'update_at' => date('Y-m-d H:i:s', time())
                ]);
            $res = DB::table('groups')->whereRaw("group_id = '$group_id'")->first();
            if (!$res) {
                $res = $cool->getGroupInfo($group_id);
                $res = DB::table('groups')->create(['group_id' => $group_id, 'name' => $res->group_name, 'create_at' => $time, 'update_at' => $time]);
                $cool->sendGroupMsg($group_id, '给你配种进群了！！！请发送help获取使用指南');
            }
            $self = $request->get('self_id');
            //指令判断
            if (Cache::get($group_id) == '1') {
                $r = random_int(0, 100);
                if (!empty(Cache::get('g_' . $group_id . '_tip'))) {
                    return;
                }
                if ($r == 98) {
                    Cache::set('g_' . $group_id . '_tip', '1', 60 * 60 * 5);
                    $cool->sendGroupMsg($group_id, '人家想和你们一块玩，球球你们发一个【说话啊】!!');
                }
                return;
            }
            if (!empty($request->get('group_id'))) {
                $end_time = 0;
                //出现则复读
                $timestamp = strtotime($time);
                $end_time = date('Y-m-d H:i:s', $timestamp - 15);
                $repeat = DB::table('messages')
                    ->whereRaw("content =  '$message' and group_id  =  $group_id")
                    ->andWhereRaw("create_at between  '$end_time' and '$time'")->count();
                $random = random_int(0, 99);
                Log::info('random:' . $random . '  group:' . $group_id);
//                如果最近没什么人说话，那就进行提权
                if ($repeat > 1) {
                    //避免多次复制
                    RepeaterEvent::handler($cool, $group_id, $message);
                    return;
                } elseif (85 > $random && $random > 65) {
                    RandomEvent::handler($cool, $group_id);
                    return;
                } else {
                    //查询词库
                    //查询最近没说话的群
                    //随机艾特一个人
                }
            }


        }
    }

    public function getCommand($query)
    {
        //查询是否在数组中

        //调动相应动作

    }


}
