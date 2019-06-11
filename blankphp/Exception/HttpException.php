<?php


namespace Blankphp\Exception;


class HttpException extends Exception
{

    public function render()
    {
        return response($this->message)->header($this->code)->send();
    }

}