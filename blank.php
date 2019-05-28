<?php
//cli模式  —— 运行一定的命令
//读取指定目录下的文件，然后运行不同的命令
    //清理blank.php文件
array_shift($argv);
$mod = $argv[0];
$command= explode(':',$mod);

//分割一下,使用一个command类来进行
if ($argv[0]='config:cache') {
    //1.创建缓存,刷新缓存
    $config=[];
    if (is_dir(__DIR__.'/config')){
        if ($dh = opendir(__DIR__.'/config')){
            while (($file = readdir($dh)) !== false){
                if (preg_match_all("/(.+?)\.php/",$file,$matches)){
                    $config[$matches[1][0]]=require __DIR__.'/config/'.$matches[0][0];
                }
            }
            closedir($dh);
        }
    }
    $text='<?php return '.var_export($config,true).';';
    file_put_contents(__DIR__.'/cache/framework/config.php',$text);

} elseif ($argv[0]) {
    //2.创建模板文件,清空

} elseif ($argv[0]) {
    //3.执行创建数据库

} elseif ($argv[0]) {
    //4.刷新缓存等命令

} elseif ($argv[0]) {
    //4.刷新缓存等命令

}else{

}




