<?

namespace App\Controllers;

use App\Controllers\Base\BaseController;
use App\Models\Categoria;
use Enkel\Controllers\Message;

class CategoriaController extends BaseController{



    function index()
    {
        $listaCategorias = Categoria::listaTodosComCategoriaPai();
        $this->setData("listaCategorias",$listaCategorias);
        return $this->render();
    }

    function novo()
    {
        $listaCategorias = Categoria::listaTodos();

        $this->setData("listaCategorias",$listaCategorias);

        if(isset($_POST['cadastrar']))
        {
            $categoria = new Categoria();
            $categoria->setNome($_POST["nome"]);
            $categoria->setCategoriaPaiId($_POST["categoriaPai"] ? $_POST["categoriaPai"] : null);

            
            $validacao = $categoria->validar();
            if($validacao["sucesso"])
            {
                $sucesso = $categoria->gravar();
            
                if($sucesso)
                {
                    Message::set("sucesso","Cadastro efetuado com sucesso!!!");
                    $this->redirect("categoria");
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
   
    function editar($params)
    {
        $categoria = Categoria::buscar($params["id"]);
        
        if($categoria)
        {
            $listaCategorias = Categoria::listaTodos();
            $this->setData("listaCategorias",$listaCategorias);
            $this->setData("categoria",$categoria);

        }
        else
        {
            $this->redirect("categoria");
        }

        if(isset($_POST['editar']))
        {
            $categoria->setNome($_POST["nome"]);
            $categoria->setCategoriaPaiId($_POST["categoriaPai"] ? $_POST["categoriaPai"] : null);

            $this->setData("categoria",$categoria);
            

            $validacao = $categoria->validar();
            if($validacao["sucesso"])
            {
                $sucesso = $categoria->editar();
            
                if($sucesso)
                {
                    Message::set("sucesso","Categoria editada com sucesso!!");

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
        $categoria = Categoria::buscar($params["id"]);
        if($categoria)
        {
            if($categoria->deletar())
            {
                Message::set("sucesso","Categoria deletada com sucesso!!!");
            }
            else
            {
                Message::set("erro","Erro ao deletar");

            }
           

        }
       
        $this->redirect("categoria");


    }

}