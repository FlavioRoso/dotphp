<?

namespace App\Controllers;


use App\Controllers\Base\BaseController;
use App\Models\Cliente;
use Enkel\Controllers\Message;

class ClienteController extends BaseController{



    function index()
    {
        
        $listaClientes = Cliente::listaTodos();
        $this->setData("listaCliente",$listaClientes);

        return $this->render();
    }

    function novo()
    {
        $listaCategorias = Cliente::listaTodos();

        $this->setData("listaCategorias",$listaCategorias);

        if(isset($_POST['cadastrar']))
        {
            $cliente = new Cliente();
            $cliente->setNome($_POST["nome"]);
            $cliente->setCpf($_POST["cpf"]);
            $cliente->setEmail($_POST["email"]);
            $cliente->setLogradouro($_POST["logradouro"]);
            $cliente->setTelefone($_POST["telefone"]);
            $cliente->setCelular($_POST["celular"]);
            $cliente->setComplemento($_POST["complemento"]);
            $cliente->setCidade($_POST["cidade"]);
            $cliente->setCep($_POST["cep"]);
            $cliente->setUf($_POST["uf"]);
            $cliente->setNumero($_POST["numero"]);
            $cliente->setBairro($_POST["bairro"]);
        
            $validacao = $cliente->validar();
            if($validacao)
            {
                $sucesso = $cliente->gravar();
            
                if($sucesso)
                {
                    Message::set("sucesso","Cadastro efetuado com sucesso!!!");
                   // $this->redirect("cliente/" . $sucesso);
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

           $this->redirect("cliente");
        }
        
        return $this->render();
    }
    function editar($params)
    {
        $cliente = Cliente::buscar($params["id"]);
        
        if($cliente)
        {
            $listaCliente = Cliente::listaTodos();
            $this->setData("listaCliente",$listaCliente);
            $this->setData("cliente",$cliente);

        }
        else
        {
            $this->redirect("cliente");
        }

        if(isset($_POST['editar']))
        {
            $cliente->setNome($_POST["nome"]);
            $cliente->setCpf($_POST["cpf"]);
            $cliente->setEmail($_POST["email"]);
            $cliente->setLogradouro($_POST["logradouro"]);
            $cliente->setTelefone($_POST["telefone"]);
            $cliente->setCelular($_POST["celular"]);
            $cliente->setComplemento($_POST["complemento"]);
            $cliente->setCidade($_POST["cidade"]);
            $cliente->setCep($_POST["cep"]);
            $cliente->setUf($_POST["uf"]);
            $cliente->setNumero($_POST["numero"]);
            $cliente->setBairro($_POST["bairro"]);

            $this->setData("cliente",$cliente);
            

            $validacao = $cliente->validar();
            if($validacao["sucesso"])
            {
                $sucesso = $cliente->editar();
            
                if($sucesso)
                {
                    Message::set("sucesso","Cliente editado com sucesso!!");

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
        $cliente = Cliente::buscar($params["id"]);
        if($cliente)
        {
            if($cliente->deletar())
            {
                Message::set("sucesso","Categoria deletada com sucesso!!!");
            }
            else
            {
                Message::set("erro","Erro ao deletar");

            }
           

        }
       
        $this->redirect("cliente");


    }

}