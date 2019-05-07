<?php
//cli模式  —— 运行一定的命令
//读取指定目录下的文件，然后运行不同的命令
    //清理blank.php文件
array_shift($argv);
$mod = $argv[0];
$command= explode(':',$mod);
print_r($command);

//分割一下,使用一个command类来进行
if ($argv[0]) {
    //1.创建缓存,刷新缓存

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




