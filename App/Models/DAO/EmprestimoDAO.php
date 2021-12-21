<?

namespace App\Models\DAO;

use App\Models\Emprestimo;
use App\Controllers\DB\DbFactory;

class EmprestimoDAO
{

    function map(Emprestimo $emprestimo, $item)
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

    function gravar(Emprestimo $emprestimo)
    {
        $banco = DbFactory::getInstance();

        $sql = "INSERT INTO emprestimo (cliente_id, funcionario_id, exemplar_id, dataLimite, dataCadastro, quantidadeRenovacoes, ativo) VALUE (:cliente_id, :funcionario_id, :exemplar_id, :dataLimite, :dataCadastro, :quantidadeRenovacoes, :ativo)";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":cliente_id" => $emprestimo->getClienteId(),
            ":funcionario_id" => $emprestimo->getFuncionarioId(),
            ":exemplar_id" => $emprestimo->getExemplarId(),
            ":dataLimite" => $emprestimo->getDataLimite(),
            ":dataCadastro" => $emprestimo->getDataCadastro(),
            ":quantidadeRenovacoes" => 0,
            ":ativo" => $emprestimo->getAtivo()
        ]);



        return $result ?  $banco->lastInsertId() : $result;
    }

    function editar(Emprestimo $emprestimo)
    {
        $banco = DbFactory::getInstance();

        $sql = "UPDATE emprestimo  
                SET  cliente_id = :cliente_id,
                    funcionario_id = :funcionario_id,
                    exemplar_id = :exemplar_id,
                    dataLimite = :dataLimite,
                    dataCadastro = :dataCadastro,
                    quantidadeRenovacoes = :quantidadeRenovacoes,
                    ativo = :ativo
                WHERE id = :id";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":id" => $emprestimo->getId(),
            ":cliente_id" => $emprestimo->getClienteId(),
            ":funcionario_id" => $emprestimo->getFuncionarioId(),
            ":exemplar_id" => $emprestimo->getExemplarId(),
            ":dataLimite" => $emprestimo->getDataLimite(),
            ":dataCadastro" => $emprestimo->getDataCadastro(),
            ":quantidadeRenovacoes" => $emprestimo->getQuantidadeRenovacoes(),
            ":ativo" => $emprestimo->getAtivo()
        ]);



        return $result ;
    }

    function buscar($id)
    {
        $banco = DbFactory::getInstance();
        $emprestimo = null;
        $sql = "SELECT id, cliente_id, funcionario_id, exemplar_id, dataLimite, dataCadastro, quantidadeRenovacoes, ativo FROM emprestimo WHERE id = ? LIMIT 1";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$id]);

        if ($result) {
            $item = $result[0];
            $emprestimo = new Emprestimo();
            $this->map($emprestimo, $item);
        } else {
            return false;
        }

        return $emprestimo;
    }

    function buscarEmprestimosCliente($clientId)
    {
        $banco = DbFactory::getInstance();
        $listaEmprestimos = null;
        $sql = "SELECT id, cliente_id, funcionario_id, exemplar_id, dataLimite, dataCadastro, quantidadeRenovacoes, ativo FROM emprestimo WHERE cliente_id = ? ORDER BY ativo DESC";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$clientId]);

        if ($result) {
            foreach ($result as $item) {
                $emprestimo = new Emprestimo();
                $this->map($emprestimo, $item);
                $listaEmprestimos[] = $emprestimo;
            }
        } else {
            return false;
        }

        return $listaEmprestimos;
    }

    function buscarQuantidadeEmprestimoAtivosCliente($id)
    {
        $banco = DbFactory::getInstance();
        $exemplar = null;
        $sql = "SELECT count(id) FROM emprestimo WHERE cliente_id = ? AND ativo IS TRUE";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$id]);

        if ($result) {
            return $result[0][0];
        } else {
            return false;
        }

        return $exemplar;
    }


}
