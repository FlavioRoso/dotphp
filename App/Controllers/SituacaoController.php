<?

namespace App\Controllers;

use Enkel\Controllers\Message;
use Enkel\Controllers\Session;
use Enkel\Http\HttpHelper;
use App\Controllers\Base\BaseController;
use App\Controllers\DB\DbFactory;
use App\Models\Cliente;
use App\Models\Exemplar;
use App\Models\Emprestimo;
use App\Models\Parametrizacao;
use App\Models\Situacao;

class SituacaoController extends BaseController
{
    function index()
    {
        return $this->render();
    }

    function cliente($params)
    {
        $cliente = Cliente::buscarPorCpf($params["cpf"]);

        if ($cliente) {
            $situacao = Situacao::buscarSitacaoAtivaCliente($cliente->getId());
            if($situacao)
            {
                Message::set("erro","Cliente em bloqueio até dia : " . date("d/m/Y",strtotime($situacao->getDataFinalBloqueio())));
                $this->setData("situacao",$situacao);
            }
            else 
            {
                Message::set("Sucesso","Cliente não possui nenhuma pendencia");
            }
            $listaEmprestimos = Situacao::buscarEmprestimosCliente($cliente->getId());
            
            if ($listaEmprestimos) 
            {
                
                    foreach ($listaEmprestimos as $emprestimo) 
                    {
                            $exemplar = Exemplar::buscar($emprestimo->getExemplarId());
                            $emprestimo->setExemplar($exemplar);
                        
                    }
                $this->setData("listaEmprestimos", $listaEmprestimos);
            }
            $this->setData("cliente", $cliente);
        } else {
            Message::set("erro", "Cliente não encontrado!!");
            $this->redirect("situacao");
        }

        return $this->render();
    }

    function regularizar($param)
    {
        $situacao = Situacao::buscar($param["id"]);
        $emprestimo = Emprestimo::buscar($situacao->getEmprestimoId());

        if ($emprestimo) {
            $cliente = Cliente::buscar($emprestimo->getClienteId());

            $login = $this->getData('login');
            $situacao->setFuncionarioId($login["id"]);
            $situacao->setDataFinalBloqueio(date("Y-m-d"));
           
            $banco = DbFactory::getInstance();
            if($situacao->editar())
            {
                Message::set("sucesso","Situação resolvida com sucesso");
            }
            else
            {
                Message::set("erro","Culpa do programador!");

            }
    

            $this->redirect("emprestimo/cliente/".$cliente->getCpf());
        }

    }
}
