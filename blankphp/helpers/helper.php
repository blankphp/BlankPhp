<?php
if (! function_exists('app')) {
    function app($instance)
    {

    }
}

if (! function_exists('view')) {
    function view($view = null, $data = [], $mergeData = [])
    {
        $factory = app(\Blankphp\View\Contract\ViewContract::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }
}
