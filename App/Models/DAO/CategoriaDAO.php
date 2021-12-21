<?

namespace App\Models\DAO;

use App\Models\Categoria;
use App\Controllers\DB\DbFactory;

class CategoriaDAO{


    function gravar(Categoria $categoria) 
    {
        $banco = DbFactory::getInstance();

        $sql = "INSERT INTO categoria (categoriaPai,nome) VALUE (:categoriaPai,:nome)";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":categoriaPai" => $categoria->getCategoriaPaiId(),
            ":nome" => $categoria->getNome(),
        ]);
            

      
        return $result ?  $banco->lastInsertId() : $result ;

        

    }

    function editar(Categoria $categoria) 
    {
        $banco = DbFactory::getInstance();

        $sql = "UPDATE  categoria SET categoriaPai = :categoriaPai, nome = :nome WHERE id = :id";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([
            ":id" => $categoria->getId(),
            ":categoriaPai" => $categoria->getCategoriaPaiId(),
            ":nome" => $categoria->getNome()
        ]);
      
        return $result;

        

    }

    function deletar($id) 
    {
        $banco = DbFactory::getInstance();

        $sql = "DELETE FROM categoria WHERE id = ?";

        $banco->setComandoSQL($sql);
        $result = $banco->executeNonQuery([$id]);
      
        return $result;

        

    }

    function listaTodos() 
    {
        
        $listaCategorias = [];
        $banco = DbFactory::getInstance();
        
        $sql = "SELECT id, categoriaPai, nome FROM categoria ";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery();

        if($result)
        {
            foreach($result as $item)
            {
                $categoria = new Categoria();
                $categoria->setId($item["id"]);
                $categoria->setNome($item["nome"]);
                $categoria->setCategoriaPaiId($item["categoriaPai"]);
                $listaCategorias [] = $categoria;

            }
        }
        else
        {
            return false;
        }

        return $listaCategorias;



    }

    function listaTodosComCategoriaPai() 
    {
        
        $listaCategorias = [];
        $banco = DbFactory::getInstance();
        
        $sql = "SELECT id, categoriaPai, nome, (SELECT nome FROM categoria WHERE id = c.categoriaPai  ) nomePai  FROM categoria c";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery();

        if($result)
        {
            foreach($result as $item)
            {

                $categoria = new Categoria();
                $categoria->setId($item["id"]);
                $categoria->setNome($item["nome"]);
                $categoria->setCategoriaPaiId($item["categoriaPai"]);


                if($item["nomePai"])
                {
                    $categoriaPai =  new Categoria(
                        $item["categoriaPai"], 
                        $item["nomePai"], 
                        null,
                    );
                    
                    $categoria->setCategoriaPai($categoriaPai);
                }

               
                $listaCategorias [] = $categoria;

            }
        }
        else
        {
            return false;
        }

        return $listaCategorias;



    }

    function buscar($id) 
    {
        
          
        $banco = DbFactory::getInstance();
        $categoria = null;
        $sql = "SELECT id, categoriaPai, nome FROM categoria WHERE id = ?";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$id]);

        if($result)
        {
            $item = $result[0];
            $categoria = new Categoria( $item["id"],$item["nome"], $item["categoriaPai"] );
           
        }
        else
        {
            return false;
        }

        return $categoria;

    }


   

   
}