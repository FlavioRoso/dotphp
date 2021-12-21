<?

namespace App\Models\DAO;

use App\Models\Funcionario;
use App\Controllers\DB\DbFactory;

use function PHPSTORM_META\map;

class FuncionarioDAO{

    function map($dado,$funcionario)
    {

        $funcionario->setId($dado["id"]);
        $funcionario->setNome($dado["nome"]);
        $funcionario->setLogin($dado["login"]);
        $funcionario->setSenha($dado["senha"]);
        $funcionario->setPapel($dado["papel"]);
        $funcionario->setCep($dado["cep"]);
        $funcionario->setNumero($dado["numero"]);
        $funcionario->setLogradouro($dado["logradouro"]);
        $funcionario->setBairro($dado["bairro"]);
        $funcionario->setCidade($dado["cidade"]);
        $funcionario->setUf($dado["uf"]);
        
        $funcionario->setComplemento($dado["complemento"]);
        $funcionario->setImagemPerfil($dado["imagem_perfil"]);
    }

    function gravar(Funcionario $funcionario) 
    {
        $banco = DbFactory::getInstance();

        $sql = "INSERT INTO funcionario 
                (
                    nome,
                    login,
                    senha,
                    papel,
                    cep,
                    numero,
                    logradouro,
                    bairro,
                    cidade,
                    uf,
                    complemento,
                    imagem_perfil,
                    ativo
                ) 
                VALUE (
                    :nome,
                    :login,
                    :senha,
                    :papel,
                    :cep,
                    :numero,
                    :logradouro,
                    :bairro,
                    :cidade,
                    :uf,
                    :complemento,
                    :imagem_perfil,
                    :ativo
                )";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":nome" => $funcionario->getNome(),
            ":login" => $funcionario->getLogin(),
            ":senha" => $funcionario->getSenha(),
            ":papel" => $funcionario->getPapel(),
            ":cep" => $funcionario->getCep(),
            ":numero" => $funcionario->getNumero(),
            ":logradouro" => $funcionario->getLogradouro(),
            ":bairro" => $funcionario->getBairro(),
            ":cidade" => $funcionario->getCidade(),
            ":uf" => $funcionario->getUf(),
            ":complemento" => $funcionario->getComplemento(),
            ":imagem_perfil" => $funcionario->getImagemPerfil(),
            ":ativo" => $funcionario->getPapel()
        ]);
            

      
        return $result ?  $banco->lastInsertId() : $result ;

        

    }

    function editar(Funcionario $funcionario) 
    {
        $banco = DbFactory::getInstance();

        $sql = "UPDATE  funcionario 
                SET 
                    nome = :nome,
                    login = :login,
                    senha = :senha,
                    papel = :papel,
                    cep = :cep,
                    numero = :numero,
                    logradouro = :logradouro,
                    bairro = :bairro,
                    cidade = :cidade,
                    uf = :uf,
                    complemento = :complemento,
                    imagem_perfil = :imagem_perfil
                WHERE id = :id";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":id" => $funcionario->getId(),
            ":nome" => $funcionario->getNome(),
            ":login" => $funcionario->getLogin(),
            ":senha" => $funcionario->getSenha(),
            ":papel" => $funcionario->getPapel(),
            ":cep" => $funcionario->getCep(),
            ":numero" => $funcionario->getNumero(),
            ":logradouro" => $funcionario->getLogradouro(),
            ":bairro" => $funcionario->getBairro(),
            ":cidade" => $funcionario->getCidade(),
            ":uf" => $funcionario->getUf(),
            ":complemento" => $funcionario->getComplemento(),
            ":imagem_perfil" => $funcionario->getImagemPerfil()
        ]);
      
        return $result;

        

    }

    function deletar($id) 
    {
        $banco = DbFactory::getInstance();

        $sql = "UPDATE  funcionario SET ativo = 0 WHERE id = ?";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([$id]);
      
        return $result;

    }

    function validaPrimeiroAcesso()
    {
        
        $banco = DbFactory::getInstance();

        $sql = "SELECT id FROM funcionario  WHERE ativo = 1";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery();
      
        return $result ? false : true;
    }

    function verificaLoginExistente($login)
   {
        $banco = DbFactory::getInstance();
        $sql = "SELECT  
                  id 
                FROM funcionario WHERE login = :login ";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([
            ":login" => $login,
        ]);

        if($result)
        {
           return true;
        }

        return false;

   }


   function buscarLogin($login,$senha)
   {
        $banco = DbFactory::getInstance();
        $funcionario = false;
        $sql = "SELECT  
                    id,
                    nome,
                    login,
                    senha,
                    papel,
                    cep,
                    numero,
                    logradouro,
                    bairro,
                    cidade,
                    uf,
                    complemento,
                    ativo,
                    imagem_perfil 
                FROM funcionario WHERE login = :login AND senha = :senha AND ativo = 1";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([
            ":login" => $login,
            ":senha" => $senha
        ]);

        if($result)
        {
            $item = $result[0];
            $funcionario = new Funcionario();
            $this->map($item,$funcionario);
        }


        return $funcionario;

   }

    function buscar($id) 
    {
        
          
        $banco = DbFactory::getInstance();
        $funcionario = null;
        $sql = "SELECT  
                    id,
                    nome,
                    login,
                    senha,
                    papel,
                    cep,
                    numero,
                    logradouro,
                    bairro,
                    cidade,
                    uf,
                    complemento,
                    imagem_perfil 
                FROM funcionario WHERE id = ?";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$id]);

        if($result)
        {
            $item = $result[0];
            $funcionario = new Funcionario();
            $this->map($item,$funcionario);
           
           
        }
        else
        {
            return false;
        }

        return $funcionario;

    }

    

    function listaTodos() 
    {
        
        $listaFuncionarios = [];
        $banco = DbFactory::getInstance();
        
        $sql = "SELECT  
                    id,
                    nome,
                    login,
                    senha,
                    papel,
                    cep,
                    numero,
                    logradouro,
                    bairro,
                    cidade,
                    uf,
                    complemento,
                    imagem_perfil 
                FROM funcionario WHERE ativo IS TRUE ";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery();

        if($result)
        {
            foreach($result as $item)
            {
                $funcionario = new Funcionario();
                $this->map($item,$funcionario);
                $listaCategorias [] = $funcionario;

            }
        }
        else
        {
            return false;
        }

        return $listaCategorias;



    }

   

   
}