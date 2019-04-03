<?php


//$mail = '/user/<id>';  //邮箱地址
/*$pattern = "/<.*?>/";*/
//$data=explode('/',$mail);
//preg_match_all($pattern, $mail, $matches);
//
//var_dump($matches,$data);  //输出匹配结果


$pattern = '[0-9]+?';  //邮箱地址
$data=array_filter(explode('/','/user/111'));
var_dump($data[2],is_numeric( $data[2]));
