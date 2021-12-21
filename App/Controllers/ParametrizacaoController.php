<?

namespace App\Controllers;


use App\Controllers\Base\BaseController;
use App\Models\Parametrizacao;
use Enkel\Controllers\Message;

class ParametrizacaoController extends BaseController{





    function index()
    {
        $parametrizacao = Parametrizacao::buscar();

        if($parametrizacao)
        {
            $this->setData("parametrizacao",$parametrizacao);

        }
        else
        {
            $this->setData("parametrizacao",new Parametrizacao());
        }

        if(isset($_POST['cadastrar']))
        {

            $parametrizacao = new Parametrizacao();
            $parametrizacao->setMultaDiaAtraso($_POST["multaDiaAtraso"]);
            $parametrizacao->setLimiteEmprestimoSimultaneos($_POST["limiteEmprestimoSimultaneos"]);
            $parametrizacao->setRazaoSocial($_POST["razaoSocial"]);
            
            if ($_FILES['logo']['error'] == 4)
            {
                $caminho = "~/imagens/logo.png";
                $parametrizacao->setLogo($caminho);
            }
            else if(isset($_FILES['logo']))
            {
                $ext = strtolower(substr($_FILES['logo']['name'],-4)); //Pegando extensão do arquivo
                $novonome =  $_POST["razaoSocial"] . $ext; //Definindo um novo nome para o arquivo
                $dir = 'C:/xampp/htdocs/biblioteca-eng2/public/imagens/'; //Diretório para uploads
                $caminho = "~/imagens/" . $novonome;
                move_uploaded_file($_FILES['logo']['tmp_name'], $dir.$novonome); //Fazer upload do arquivo
                $parametrizacao->setLogo($caminho);
            }

            $validacao = $parametrizacao->validar();
            if($validacao["sucesso"])
            {

                $sucesso = $parametrizacao->gravar();
                if($sucesso)
                {
                    Message::set("sucesso","Cadastro efetuado com sucesso!!!");
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

}