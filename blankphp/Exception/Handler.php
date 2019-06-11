<?php


namespace Blankphp\Exception;


class Handler
{

    public function handToConsole( $e){

    }

    public function handToRender( $e){
        if ($e instanceof Exception)
             $e->render();
        else
            var_dump($e);
    }
}