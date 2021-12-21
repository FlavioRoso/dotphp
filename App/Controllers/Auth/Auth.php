<?

namespace App\Controllers\Auth;

use Enkel\Controllers\Session;

class Auth{

    static function validaPermissao($range)
    {
        $valido = false;
        $login = Session::get("login");
        if($login)
        {
            foreach($range as $permissao)
            {
                $valido = $permissao == $login["papel"];
            }
        }

        return $valido;
    }
}