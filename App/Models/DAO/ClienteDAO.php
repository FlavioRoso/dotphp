<?

namespace App\Models\DAO;

use App\Controllers\DB\DbFactory;
use App\Models\Cliente;

class ClienteDAO
{

    function map(Cliente $cliente, $item)
    {
        $cliente->setId($item["id"]);
        $cliente->setNome($item["nome"]);
        $cliente->setCpf($item["cpf"]);
        $cliente->setTelefone($item["telefone"]);
        $cliente->setCelular($item["celular"]);
        $cliente->setEmail($item["email"]);
        $cliente->setCep($item["cep"]);
        $cliente->setLogradouro($item["logradouro"]);
        $cliente->setUf($item["uf"]);
        $cliente->setCidade($item["cidade"]);
        $cliente->setBairro($item["bairro"]);
        $cliente->setNumero($item["numero"]);
        $cliente->setComplemento($item["complemento"]);
    }


    function gravar(Cliente $cliente)
    {
        $banco = DbFactory::getInstance();

        $sql = "INSERT INTO cliente (nome,cpf,telefone,celular,email,cep,logradouro,uf,cidade,bairro,numero,complemento)
     VALUE (:nome,:cpf,:telefone,:celular,:email,:cep,:logradouro,:uf,:cidade,:bairro,:numero,:complemento)";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":nome" => $cliente->getNome(),
            ":cpf" => $cliente->getCpf(),
            ":telefone" => $cliente->getTelefone(),
            ":celular" => $cliente->getCelular(),
            ":email" => $cliente->getEmail(),
            ":cep" => $cliente->getCep(),
            ":logradouro" => $cliente->getLogradouro(),
            ":uf" => $cliente->getUf(),
            ":cidade" => $cliente->getCidade(),
            ":bairro" => $cliente->getBairro(),
            ":numero" => $cliente->getNumero(),
            ":complemento" => $cliente->getComplemento()
        ]);

        return $result ?  $banco->lastInsertId() : $result;
    }

    function editar(Cliente $cliente)
    {
        $banco = DbFactory::getInstance();

        $sql = "UPDATE  cliente SET nome = :nome, cpf = :cpf,telefone = :telefone,celular = :celular,
    email = :email,cep = :cep,logradouro = :logradouro,uf = :uf,cidade = :cidade,bairro = :bairro,numero = :numero,
    complemento = :complemento WHERE id = :id";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":id" => $cliente->getId(),
            ":nome" => $cliente->getNome(),
            ":cpf" => $cliente->getCpf(),
            ":telefone" => $cliente->getTelefone(),
            ":celular" => $cliente->getCelular(),
            ":email" => $cliente->getEmail(),
            ":cep" => $cliente->getCep(),
            ":logradouro" => $cliente->getLogradouro(),
            ":uf" => $cliente->getUf(),
            ":cidade" => $cliente->getCidade(),
            ":bairro" => $cliente->getBairro(),
            ":numero" => $cliente->getNumero(),
            ":complemento" => $cliente->getComplemento()
        ]);

        return $result;
    }

    function deletar($id)
    {
        $banco = DbFactory::getInstance();
        $sql = "DELETE FROM cliente WHERE id = ?";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([$id]);

        return $result;
    }

    function listaTodos()
    {

        $listaCliente = [];
        $banco = DbFactory::getInstance();

        $sql = "SELECT id,nome,cpf,telefone,celular,email,cep,logradouro,uf,
    cidade,bairro,numero,complemento FROM cliente ";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery();

        if ($result) {
            foreach ($result as $item) {
                $cliente = new Cliente();
                $this->map($cliente, $item);
                $listaCliente[] = $cliente;
            }
        } else {
            return false;
        }

        return $listaCliente;
    }

    function getListNome($filtro)
    {

        $listaCategorias = [];
        $banco = DbFactory::getInstance();

        $sql = "SELECT * from cliente";



        if (!empty($filtro)) {
            $sql .= " where nome LIKE '%$filtro%' order by id";
        }

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery();

        if ($result) {
            foreach ($result as $item) {

                $cliente = new Cliente();
                $this->map($cliente, $item);

                $listaCliente[] = $cliente;
            }
        } else {
            return false;
        }

        return $listaCategorias;
    }

    function buscar($id)
    {


        $banco = DbFactory::getInstance();
        $cliente = null;
        $sql = "SELECT id, nome, cpf, telefone, celular, email, cep, logradouro ,uf , cidade, bairro, numero, complemento FROM cliente WHERE id = ?";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$id]);

        if ($result) {
            $item = $result[0];
            $cliente = new Cliente();
            $this->map($cliente, $item);
        } else {
            return false;
        }

        return $cliente;
    }

    function verificaPendencia($id)
    {
        $banco = DbFactory::getInstance();
        $sql = "SELECT c.id  FROM cliente c 
        LEFT JOIN situacao s ON s.cliente_id = c.id
        LEFT JOIN emprestimo e ON e.cliente_id = c.id
        WHERE 
            c.id = ? AND
            e.ativo = 1 AND
            (s.dataFinalBloqueio > CURDATE() OR
            e.dataLimite < CURDATE() )
            ";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$id]);
        var_dump($result);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function buscarPorCpf($cpf)
    {


        $banco = DbFactory::getInstance();
        $cliente = null;
        $sql = "SELECT id,nome,cpf,telefone,celular,email,cep,logradouro,uf,
    cidade,bairro,numero,complemento FROM cliente WHERE cpf = ?";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$cpf]);

        if ($result) {
            $item = $result[0];
            $cliente = new Cliente();
            $this->map($cliente, $item);
        } else {
            return false;
        }

        return $cliente;
    }
}
