<?

namespace App\Controllers;

use App\Controllers\Base\BaseController;
use App\Models\Funcionario;
use Enkel\Controllers\Message;

class FuncionarioController extends BaseController{



    function index()
    {
        $listaFuncionarios = funcionario::listaTodos();
        $this->setData("listaFuncionarios",$listaFuncionarios);
        return $this->render();


    }

    function novo()
    {

        if(isset($_POST['cadastrar']))
        {
            $funcionario = new Funcionario();
            $funcionario->setNome($_POST["nome"]);
            $funcionario->setLogin($_POST["login"]);
            $funcionario->setSenha($funcionario->criptografar($_POST["senha"]));
            $funcionario->setPapel($_POST["papel"]);
            $funcionario->setCep($_POST["cep"]);
            $funcionario->setNumero($_POST["numero"]);
            $funcionario->setLogradouro($_POST["logradouro"]);
            $funcionario->setCidade($_POST["cidade"]);
            $funcionario->setUf($_POST["uf"]);
            $funcionario->setComplemento($_POST["complemento"]);
            $funcionario->setBairro($_POST["bairro"]);


            
            $validacao = $funcionario->validar();
            if($validacao["sucesso"])
            {
                $sucesso = $funcionario->gravar();
            
                if($sucesso)
                {
                    Message::set("sucesso","Cadastro efetuado com sucesso!!!");
                    $this->redirect("funcionario");
                }
                else
                {
                    Message::set("erro","Erro ao gravar no banco!!");
                }
            }
            else
            {
                $this->setData("erro",$validacao["msg"]);
            }

           
        }
        
        return $this->render();
    }

    function editar($parans)
    {
        $funcionario = Funcionario::buscar($parans["id"]);
        
        if($funcionario)
        {
            $this->setData("funcionario",$funcionario);

        }
        else
        {
            $this->redirect("funcionario");
        }

        if(isset($_POST['editar']))
        {
            $funcionario->setNome($_POST["nome"]);
            $funcionario->setLogin($_POST["login"]);
            if($_POST["senha"] != "")
            {
                $funcionario->setSenha($funcionario->criptografar($_POST["senha"]));
            }
           
            
            $funcionario->setPapel($_POST["papel"]);
            $funcionario->setCep($_POST["cep"]);
            $funcionario->setNumero($_POST["numero"]);
            $funcionario->setLogradouro($_POST["logradouro"]);
            $funcionario->setCidade($_POST["cidade"]);
            $funcionario->setUf($_POST["uf"]);
            $funcionario->setComplemento($_POST["complemento"]);
            $funcionario->setBairro($_POST["bairro"]);

            
            $validacao = $funcionario->validar();
            if($validacao["sucesso"])
            {
                $sucesso = $funcionario->editar();
            
                if($sucesso)
                {
                    Message::set("sucesso","Funcionario editado com sucesso!!!");
                }
                else
                {
                    Message::set("erro","Erro ao gravar no banco!!");
                }
            }
            else
            {
                Message::set("erro",$validacao["msg"]);
            }


        }

        return $this->render();
    }

    function deletar($params){
        $funcionario = funcionario::buscar($params["id"]);
        if($funcionario)
        {
            if($funcionario->deletar())
            {
                Message::set("sucesso","Funcionario deletado com sucesso!!!");
            }
            else
            {
                Message::set("erro","Erro ao deletar");

            }
           

        }
       
        $this->redirect("funcionario");


    }

}