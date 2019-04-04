<?php


namespace Blankphp\Session;


class FileSessionHandler implements \SessionHandlerInterface
{
    /**
     * Close the session
     */
    public function close(){

    }

    /**
     * Destroy a session
     */
    public function destroy($session_id){

    }

    /**
     * Cleanup old sessions
     */
    public function gc($maxlifetime){

    }

    /**
     * Initialize session
     */
    public function open($save_path, $name){

    }


    /**
     * Read session data
     */
    public function read($session_id){

    }

    /**
     * Write session data

     */
    public function write($session_id, $session_data){

    }

}