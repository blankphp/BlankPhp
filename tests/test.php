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
$config=[];
if (is_dir(__DIR__.'/../config')){
    if ($dh = opendir(__DIR__.'/../config')){
        while (($file = readdir($dh)) !== false){
            if (preg_match_all("/(.+?)\.php/",$file,$matches)){
                $config[$matches[1][0]]=require __DIR__.'/../config/'.$matches[0][0];
            }
        }
        closedir($dh);
    }
}
$text='<?php return '.var_export($config,true).';';
file_put_contents(__DIR__.'/../cache/framework/config.php',$text);
print_r($config);

//function test(){
//    ob_start();
//    ob_clean();
//    include('../public/template/index.php');
//    $content=ob_get_contents();
//    ob_end_clean();
//    return $content;
//}
//
//$a=test();
//var_dump($a);

