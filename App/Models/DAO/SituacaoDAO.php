<?

namespace App\Models\DAO;

use App\Models\Situacao;
use App\Models\Parametrizacao;
use App\Models\Emprestimo;
use App\Controllers\DB\DbFactory;

class SituacaoDAO{

    function map(Situacao $situacao, $item)
    {
        $situacao->setId($item["id"]);
        $situacao->setEmprestimoId($item["emprestimo_id"]);
        $situacao->setFuncionarioId($item["funcionario_id"]);
        $situacao->setClienteId($item["cliente_id"]);
        $situacao->setTipo($item["tipo"]);
        $situacao->setDescricao($item["descricao"]);
        $situacao->setDiasAtraso($item["diasAtraso"]);
        $situacao->setDataFinalBloqueio($item["dataFinalBloqueio"]);

    }

    function mapEmprestimo(Emprestimo $emprestimo, $item)
    {
        $emprestimo->setId($item["id"]);
        $emprestimo->setClienteId($item["cliente_id"]);
        $emprestimo->setFuncionarioId($item["funcionario_id"]);
        $emprestimo->setExemplarId($item["exemplar_id"]);
        $emprestimo->setDataLimite($item["dataLimite"]);
        $emprestimo->setDataCadastro($item["dataCadastro"]);
        $emprestimo->setQuantidadeRenovacoes($item["quantidadeRenovacoes"]);
        $emprestimo->setAtivo($item["ativo"]);
    }

    function gravar(Situacao $situacao)
    {
        $banco = DbFactory::getInstance();

        $sql = "INSERT INTO situacao (emprestimo_id, funcionario_id, cliente_id, tipo, descricao, diasAtraso, dataFinalBloqueio) 
                VALUES (:emprestimo_id, :funcionario_id, :cliente_id, :tipo, :descricao, :diasAtraso, :dataFinalBloqueio)";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":emprestimo_id" => $situacao->getEmprestimoId(),
            ":funcionario_id" => $situacao->getFuncionarioId(),
            ":cliente_id" => $situacao->getClienteId(),
            ":tipo" => $situacao->getTipo(),
            ":descricao" => $situacao->getDescricao(),
            ":diasAtraso" => $situacao->getDiasAtraso(),
            ":dataFinalBloqueio" => $situacao->getDataFinalBloqueio(),
        ]);
            

      
        return $result ?  $banco->lastInsertId() : $result ;

    }

    function editar(Situacao $situacao)
    {
        $banco = DbFactory::getInstance();

        $sql = "UPDATE situacao SET 
        funcionario_id = :funcionario_id,
        dataFinalBloqueio = :dataFinalBloqueio 
        WHERE id = :id";
        
        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":id" => $situacao->getId(),
            ":funcionario_id" => $situacao->getFuncionarioId(),
            ":dataFinalBloqueio" => $situacao->getDataFinalBloqueio()
        ]);
        return $result;
    }

    function buscarSitacaoAtivaCliente($cliente_id)
    {
        $banco = DbFactory::getInstance();
        $sql = "SELECT id, emprestimo_id, funcionario_id, cliente_id, tipo, descricao, diasAtraso, dataFinalBloqueio 
                FROM situacao 
                WHERE 
                    cliente_id = ? 
                    AND dataFinalBloqueio > CURDATE()";
        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$cliente_id]);

        if($result)
        {
            $item = $result[0];

            $situacao = new Situacao();
            $this->map($situacao,$item);

            return $situacao;
        }
        else
        {
            return false;
        }
    }

    function buscarEmprestimosCliente($clientId)
    {
        $banco = DbFactory::getInstance();
        $listaEmprestimos = null;
        $sql = "SELECT e.id, e.cliente_id, e.funcionario_id,e.exemplar_id, e.dataLimite, e.dataCadastro, e.quantidadeRenovacoes, e.ativo FROM emprestimo AS e INNER JOIN situacao AS sit ON sit.emprestimo_id = e.id AND sit.dataFinalBloqueio > CURDATE() WHERE e.cliente_id = ? ORDER BY e.ativo DESC";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$clientId]);

        if ($result) {
            foreach ($result as $item) {
                $emprestimo = new Emprestimo();
                $this->mapEmprestimo($emprestimo, $item);
                $listaEmprestimos[] = $emprestimo;
            }
        } else {
            return false;
        }

        return $listaEmprestimos;
    }
   
    function valorMultaDiaria()
    {
        $parametrizacao = Parametrizacao::buscar();
        return $parametrizacao->getMultaDiaAtraso();
    }

    function buscar($id)
    {
        $banco = DbFactory::getInstance();
        $situacao = null;
        $sql = "SELECT id, emprestimo_id, funcionario_id, cliente_id, tipo, descricao, diasAtraso, dataFinalBloqueio FROM situacao WHERE id = ? LIMIT 1";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$id]);

        if ($result) {
            $item = $result[0];
            $situacao = new Situacao();
            $this->map($situacao, $item);
        } else {
            return false;
        }

        return $situacao;
    }

    function buscarPorEmprestimo($emprestimoId)
    {
        $banco = DbFactory::getInstance();
        $listaSituacao = null;
        $sql = "SELECT id, emprestimo_id, funcionario_id, cliente_id,  tipo, descricao, diasAtraso, dataFinalBloqueio FROM situacao WHERE emprestimo_id = ?";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$emprestimoId]);

        if ($result) {
            foreach ($result as $item) {
                $situacao = new Situacao();
                $this->map($situacao, $item);
                $listaSituacao[] = $situacao;
            }
        } else {
            return false;
        }

        return $listaSituacao;
    }
}