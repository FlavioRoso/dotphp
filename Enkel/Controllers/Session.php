<?

namespace Enkel\Controllers;

class Session{

    static function verifySessionOpen()
    {
        if(session_id() == '') {
            session_start();
        }
    }
  
    static function set($index,$value)
    {
        self::verifySessionOpen();
        $_SESSION[$index] = $value ;
    }

    static function remove($index)
    {
        self::verifySessionOpen();
        unset($_SESSION[$index]);
    }

    static function hasIndex($index)
    {
        return isset($_SESSION[$index]);
    }


    static function get($index)
    {
        self::verifySessionOpen();

        if(isset($_SESSION[$index]))
        {
            return $_SESSION[$index];
        }
        else
        {
            return false;
        }
    }

}