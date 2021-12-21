<?

namespace App\Controllers;

use App\Models\Funcionario;
use Enkel\Controllers\Message;
use Enkel\Controllers\Controller;
use Enkel\Controllers\Session;

class LoginController extends Controller{



    function index()
    {
        $login = Session::get("login");

        if(Funcionario::validaPrimeiroAcesso())
            $this->redirect("configuracao");
       
        if($login)
        {
            $this->redirect("dashboard");
        }
        return $this->render();
    }

    function logout()
    {
        Session::remove("login");
        $this->redirect("");

    }

    function Auth()
    {
        if(isset($_POST['btnLogin']))
        {
            $funcionario = Funcionario::buscarLogin(
                            $_POST['login'],
                            Funcionario::criptografar( $_POST['senha'])
                        );

            if($funcionario)
            {
                Session::set("login",[
                    "id" => $funcionario->getId(),
                    "nome" => $funcionario->getNome(),
                    "papel" => $funcionario->getPapel()
                ]);
                $this->redirect("dashboard");

            }

            $this->redirect("");
        }
    }


   
}