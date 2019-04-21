<?php
if (!function_exists('app')) {
    function app($abstract)
    {
        $a = \Blankphp\Application::getInstance();
        if (class_exists($abstract) || interface_exists($abstract) || !is_null($desc = $a->make($abstract)))
            return $desc;
        else
            return $a->getSignal($abstract);
    }
}

if (!function_exists('config')) {
    function config($name, $default = null)
    {
        $descNames = explode('.', $name);
        $descNames = array_filter($descNames);
        return app('config.get')->get($descNames, $default);
    }
}


if (!function_exists('view')) {
    function view($view = null, $data = [])
    {
        $factory = app(\Blankphp\Contract\View::class);
        if (func_num_args() === 0) {
            return $factory;
        }
        return $factory->view($view, $data);
    }
}

if (!function_exists('view_static')) {
    function view_static($view = null, $data = [], $time = 30000)
    {
        $factory = app('view.static');
        if (func_num_args() === 0) {
            return $factory;
        }
        return $factory->view($view, $data, $time);
    }
}


if (!function_exists('url')) {
    function url($uri, $data = [])
    {
        //编译为目标地址
        $config = config('app.url');
        $url = $config . '/' . $uri;
        return $url;
    }
}

if (!function_exists('asset')) {
    function asset($uri, $data = [])
    {
        $url = config('app.url');
        $static = config('app.static');
        $url = $url . '/' . $static . '/' . $uri;
        return $url;
    }
}


