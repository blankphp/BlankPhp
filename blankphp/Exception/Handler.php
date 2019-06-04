<?php


namespace Blankphp\Exception;


class Handler
{

    public function handToConsole( $e){

    }

    public function handToRender( $e){
        $e->render();
    }
}