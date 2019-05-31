<?php
if (!function_exists('app')) {
    function app($abstract)
    {
        $a = \Blankphp\Application::getInstance();
        if (class_exists($abstract) || interface_exists($abstract) || !is_null($desc = $a->make($abstract)))
            return $a->make($abstract);
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




if (!function_exists('real_path')) {
    function real_path($path, $ff=null)
    {
        $static = config('app.static');
        $url = APP_PATH . '/' . $static . '/' . $path;
        if ($ff)
            $url=str_replace("\\","/",$url);
        return $url;
    }
}


