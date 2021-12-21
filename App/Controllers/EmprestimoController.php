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

class EmprestimoController extends BaseController
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
            $listaEmprestimos = Emprestimo::buscarEmprestimosCliente($cliente->getId());
            if ($listaEmprestimos) {


                foreach ($listaEmprestimos as $emprestimo) {
                    $exemplar = Exemplar::buscar($emprestimo->getExemplarId());
                    $emprestimo->setExemplar($exemplar);
                }

                $this->setData("listaEmprestimos", $listaEmprestimos);
            }
            $this->setData("cliente", $cliente);
        } else {
            Message::set("erro", "Cliente não encontrado!!");
            $this->redirect("emprestimo");
        }

        return $this->render();
    }

    function novo($params)
    {
        $cliente = Cliente::buscar($params["cliente_id"]);

        if ($cliente) {
            if ($cliente->existePendencia()) {
                Message::set("erro", "Cliente está com pendências!!");
                $this->redirect("emprestimo/cliente/" . $cliente->getCpf());
            }

            $this->setData("cliente", $cliente);
        } else {
            Message::set("erro", "Cliente não encontrado!!");
            $this->redirect("emprestimo");
        }

        return $this->render();
    }

    /**
     * renovar
     *
     * @param  mixed $params
     * @return void
     */
    function renovar($params)
    {
        $emprestimo = Emprestimo::buscar($params["id"]);

        if ($emprestimo && $emprestimo->getAtivo()) {
            $parametrizacao = Parametrizacao::buscar();
            $cliente = Cliente::buscar($emprestimo->getClienteId());
            $exemplar = Exemplar::buscar($emprestimo->getExemplarId());
            if ($emprestimo->getQuantidadeRenovacoes() < $parametrizacao->getLimiteEmprestimoSimultaneos()) {

                if ($exemplar->buscarQuantidadeExemplaresDisponiveisPorLivro($exemplar->getLivroId()) > 0) {
                    $exemplar = Exemplar::buscar($emprestimo->getExemplarId());
                    if (!$cliente->existePendencia()) {
                        $emprestimo->incrementaQuantidadeRenovacoes();
                        $emprestimo->setDataLimite(date("Y-m-d"));
                        $emprestimo->incrementaDiasDataLimite($exemplar->getLivro()->getDiasEmprestimo());
                        if ($emprestimo->editar()) {
                            Message::set("sucesso", "Empréstimo renovado com sucesso!!");
                        } else {
                            Message::set("erro", "Erro sistemático, entre em contato com o suporte!!");
                        }
                    } else {
                        Message::set("erro", "Cliente está com pendências!!");
                    }
                } else {
                    Message::set("erro", "Renovação indisponível, livro possui reserva!!");
                }
            } else {
                Message::set("erro", "Limite de renovações de empréstimo atingido!!");
            }

            $this->redirect("emprestimo/cliente/" . $cliente->getCpf());
        } else {
            Message::set("erro", "Empréstimo não encontrado ou finalizado!!");
        }

        $this->redirect("emprestimo");
    }

    function cadastrar($params)
    {
        $cliente = Cliente::buscar($params["cliente_id"]);
        $parametrizacao = Parametrizacao::buscar();

        $emprestimo = null;
        $retorno = [
            "sucesso" => false,
            "url" => HttpHelper::getRootDirPath() . "emprestimo/cliente/" . $cliente->getCpf(),
            "msg" => ""
        ];

        $json = file_get_contents('php://input');
        $json = json_decode($json);

        if ($json) {
            $qtdeEmprestimosAtivos = Emprestimo::buscarQuantidadeEmprestimoAtivosCliente($cliente->getId());
            $exemplares = $json->exemplares;
            if (
                count($exemplares) + $qtdeEmprestimosAtivos <=
                $parametrizacao->getLimiteEmprestimoSimultaneos()
            ) {


                $banco = DbFactory::getInstance();
                $banco->beginTransaction();
                try {
                    $login = Session::get("login");
                    foreach ($exemplares as $arrExemplar) {
                        $exemplar = Exemplar::buscar($arrExemplar->id);
                        $emprestimo = new Emprestimo();
                        $emprestimo->setExemplarId($arrExemplar->id);
                        $emprestimo->setClienteId($params["cliente_id"]);
                        $emprestimo->setDataCadastro(date("Y-m-d"));
                        $emprestimo->setDataLimite(date("Y-m-d"));
                        $emprestimo->incrementaDiasDataLimite($exemplar->getLivro()->getDiasEmprestimo());
                        $emprestimo->setAtivo(true);
                        $emprestimo->setFuncionarioId($login["id"]);

                        $emprestimo->gravar();
                    }
                    $banco->commit();

                    $retorno["sucesso"] = true;
                    Message::set("sucesso", "emprestimo realizados com sucesso!!");
                } catch (\Exception $e) {
                    $banco->rollBack();
                }
            } else {
                $retorno["sucesso"] = false;
                $retorno["msg"] = "Numero maximo de emprestimo excedido, maximo permitido é " . $parametrizacao->getLimiteEmprestimoSimultaneos() . "!!!";
            }
        }


        return json_encode($retorno);
    }

    function situacao($param)
    {
        $emprestimo = Emprestimo::buscar($param["id"]);
        if ($emprestimo && $emprestimo->getAtivo()) {
            $parametrizacao = Parametrizacao::buscar();
            $cliente = Cliente::buscar($emprestimo->getClienteId());
            $situacao = new Situacao();
            // $exemplar = Exemplar::buscar($emprestimo->getExemplarId());
            $this->setData("emprestimo",$emprestimo);
            $this->setData("cliente",$cliente);
            $this->setData("situacao",$situacao);

            if(isset($_POST["resolver"]))
            {
                $login = $this->getData('login');
                $situacao->setTipo($_POST['tipo']);
                $situacao->setDescricao($_POST['descricao']);
                $situacao->setClienteId($cliente->getId());
                $situacao->setFuncionarioId($login["id"]);
                $situacao->setEmprestimoId($emprestimo->getId());
                if($situacao->getTipo() == 1)
                {
                    $dataAtual = strtotime(date("Y-m-d"));
                    $dataLimite = strtotime($emprestimo->getDataLimite());
                    $diasAtraso = $dataAtual - $dataLimite;
                    $diasAtraso = round($diasAtraso / (60 * 60 * 24));
                    $diasBloqueio = $diasAtraso * $parametrizacao->getMultaDiaAtraso();
                    $situacao->setDiasAtraso($diasAtraso);
                    $situacao->setDataFinalBloqueio(date("Y-m-d",strtotime(date("Y-m-d") . " + " . $diasBloqueio . " weekdays" )));
                }

                $banco = DbFactory::getInstance();

                $banco->beginTransaction();
                try{
                    $situacao->gravar();
                    $emprestimo->setAtivo(false);
                    $emprestimo->editar();
                    $banco->commit();
                    Message::set("sucesso","Situação resolvida com sucesso");
                    $this->redirect("emprestimo/cliente/".$cliente->getCpf());
                }
                catch(\Exception $e)
                {
                    $banco->rollBack();
                }

            }

        } else {
            Message::set("erro", "Emprestimo não encontrado ou finalizado!!");
            $this->redirect("emprestimo");
        }

        return $this->render();
    }
}
