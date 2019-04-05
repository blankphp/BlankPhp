<?php


//$mail = '/user/<id>';  //邮箱地址
/*$pattern = "/<.*?>/";*/
//$data=explode('/',$mail);
//preg_match_all($pattern, $mail, $matches);
//
//var_dump($matches,$data);  //输出匹配结果

//
//$pattern = '[0-9]+?';  //邮箱地址
//$data=array_filter(explode('/','/user/111'));
//var_dump($data[2],is_numeric( $data[2]));
//echo __DIR__."/../config";
//$matches=[];
//$config=[];
//if (is_dir(__DIR__.'/../config')){
//    if ($dh = opendir(__DIR__.'/../config')){
//        while (($file = readdir($dh)) !== false){
//            if (preg_match_all("/(.+?)\.php/",$file,$matches)){
//                $config[$matches[1][0]]=require_once __DIR__.'/../config/'.$matches[0][0];
//            }
//        }
//        closedir($dh);
//    }
//}
//var_dump($config);


function pipe(){
    return function ($stack, $pipe) {
        return function () use ($stack, $pipe) {
            return $pipe::handle($this->app->make('request'), $stack);
        };
    };
}