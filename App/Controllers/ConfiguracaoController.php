<?

namespace App\Controllers;

use App\Models\Funcionario;
use Enkel\Controllers\Message;
use Enkel\Controllers\Controller;
use Enkel\Controllers\Session;
use App\Controllers\ParametrizacaoController;
use App\Models\Parametrizacao;

class ConfiguracaoController extends Controller{



    function index()
    {
        if(!Funcionario::validaPrimeiroAcesso())
            $this->redirect("");
            
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
            $funcionario->setPapel(1);
            $funcionario->setCep($_POST["cep"]);
            $funcionario->setNumero($_POST["numero"]);
            $funcionario->setLogradouro($_POST["logradouro"]);
            $funcionario->setCidade($_POST["cidade"]);
            $funcionario->setUf($_POST["uf"]);
            $funcionario->setComplemento($_POST["complemento"]);
            $funcionario->setBairro($_POST["bairro"]);
        
            $validacao = $funcionario->validar();
            if($validacao)
            {
                $sucesso = $funcionario->gravar();
            
                if($sucesso)
                {

            
                        $parametrizacao = new Parametrizacao();
                        $parametrizacao->setMultaDiaAtraso($_POST["multaDiaAtraso"]);
                        $parametrizacao->setLimiteEmprestimoSimultaneos($_POST["limiteEmprestimoSimultaneos"]);
                        $parametrizacao->setRazaoSocial($_POST["razaoSocial"]);
                        $parametrizacao->setLogo(null);
            
                        $validacao = $parametrizacao->validar();
                        if($validacao["sucesso"])
                        {
            
                            $sucesso = $parametrizacao->gravar();
                            if($sucesso)
                            {
                                $this->redirect("");
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
                    Message::set("sucesso","Cadastro efetuado com sucesso!!!");
                   
                }
                else
                {
                    Message::set("erro","Erro ao gravar no banco!!");
                    $this->redirect("" . $sucesso);
                }
            }
            else
            {
                $this->setData("erro",$validacao["msg"]);
            }

           //$this->redirect("cliente");
        }
        
        return $this->render();
    }
   
 
}
