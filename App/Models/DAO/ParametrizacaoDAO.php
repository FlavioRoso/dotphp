<?

namespace App\Models\DAO;

use App\Models\Parametrizacao;
use App\Controllers\DB\DbFactory;

class ParametrizacaoDAO{


    function gravar(Parametrizacao $parametrizacao) 
    {
        $banco = DbFactory::getInstance();

        $sql = "INSERT INTO parametrizacao (multaDiaAtraso,limiteEmprestimoSimultaneos,razaoSocial,logo) VALUES (:multaDiaAtraso,:limiteEmprestimoSimultaneos,:razaoSocial,:logo)";

        $banco->setComandoSQL($sql);

        $result = $banco->executeNonQuery([
            ":multaDiaAtraso" => $parametrizacao->getMultaDiaAtraso(),
            ":limiteEmprestimoSimultaneos" => $parametrizacao->getLimiteEmprestimoSimultaneos(),
            ":razaoSocial" => $parametrizacao->getRazaoSocial(),
            ":logo" => $parametrizacao->getLogo(),
        ]);   

      
        return $result ?  $banco->lastInsertId() : $result ;

        

    }


    function listaTodos() 
    {
        
        $listaParametrizacoes = [];
        $banco = DbFactory::getInstance();
        
        $sql = "SELECT id, multaDiaAtraso,limiteEmprestimoSimultaneos, razaoSocial, logo FROM parametrizacao ";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery();

        if($result)
        {
            foreach($result as $item)
            {
                $parametrizacao = new Parametrizacao();
                $parametrizacao->setId($item["id"]);
                $parametrizacao->setMultaDiaAtraso($item["multaDiaAtraso"]);
                $parametrizacao->setLimiteEmprestimoSimultaneos($item["limiteEmprestimoSimultaneos"]);
                $parametrizacao->setRazaoSocial($item["razaoSocial"]);
                $parametrizacao->setLogo($item["logo"]);
                $listaParametrizacoes [] = $parametrizacao;

            }
        }
        else
        {
            return false;
        }

        return $listaParametrizacoes;



    }

    function buscar() 
    {
        
        $parametrizacao = null;
        $banco = DbFactory::getInstance();
        
        $sql = "SELECT id, multaDiaAtraso,limiteEmprestimoSimultaneos, razaoSocial, logo FROM parametrizacao  ORDER BY id DESC LIMIT 1 ";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery();

        if($result)
        {
            $item = $result[0];
            $parametrizacao = new Parametrizacao();
            $parametrizacao->setId($item["id"]);
            $parametrizacao->setMultaDiaAtraso($item["multaDiaAtraso"]);
            $parametrizacao->setLimiteEmprestimoSimultaneos($item["limiteEmprestimoSimultaneos"]);
            $parametrizacao->setRazaoSocial($item["razaoSocial"]);
            $parametrizacao->setLogo($item["logo"]);

        }
        else
        {
            return false;
        }

        return $parametrizacao;



    }
   
}