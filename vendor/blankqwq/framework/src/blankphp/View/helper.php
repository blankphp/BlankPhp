<?php

if (!function_exists('url')) {
    function url($uri, $data = [])
    {
        //编译为目标地址
        $config = config('app.url');
        $url = $config . '/' . $uri;
        echo $url;
    }
}

if (!function_exists('asset')) {
    function asset($uri, $data = [])
    {
        $url = config('app.url');
        $static = config('app.static');
        $url = $url . '/' . $static . '/' . $uri;
        echo $url;
    }
}

if (!function_exists('include_template')) {
    function include_template($file, $data = [])
    {
//        $fileName=explode('.',$file);
//        $fileName = implode('/',$fileName) . '.php';
//        $file=APP_PATH.'resource/template/'.$fileName;
//        $descFile = APP_PATH.'cache/view/'.md5($file) . '.php';
//        var_dump($file,$descFile);
       echo view($file,$data);
    }
}




