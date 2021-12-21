<?

namespace Enkel\Controllers;


class Message{
  
    static function set($index,$msg)
    {
        $arrayMessages = Session::get("messages");
        if(!$arrayMessages)
        {
            $arrayMessages = [];
        }
        $arrayMessages[$index] = $msg;
       
        Session::set("messages",$arrayMessages);
    }

    static function hasMessage($index)
    {
        $arrayMessages = Session::get("messages");
        return $arrayMessages && isset($arrayMessages[$index]);
    }

    static function get($index)
    {
        $arrayMessages = Session::get("messages");
        $msg = false;
        if($arrayMessages)
        {
            $msg = $arrayMessages[$index];
            if($msg)
            {
                unset($arrayMessages[$index]);
                Session::set("messages",$arrayMessages);

            }

        }
  
        return $msg;

    }

}