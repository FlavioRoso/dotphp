<?

namespace App\Controllers\DB;

class MysqlDb extends \PDO
{

    private $comandoSQL;


    public function setComandoSQL($valor) {
	
        $this->comandoSQL = $this->prepare($valor);

        
    }

     //Responsável por executar os comandos de INSERT, UPDATE E DELETE
     public function executeNonQuery($parametros = null) {
        
        if ($this->comandoSQL != "") {
            if($parametros)
            {
                return($this->comandoSQL->execute($parametros));

            }
            else
            {
                return($this->comandoSQL->execute());

            }
		}
        else
            return false;
    }

    //Responsável por executar os comandos de SELECT
    public function executeQuery($parametros = null) {

        if ($this->comandoSQL) {
            if($parametros)
            {
                $this->comandoSQL->execute($parametros);

            }
            else
            {
                $this->comandoSQL->execute();

            }
            return($this->comandoSQL->fetchAll());
        }
        else
            return false;
    }





}


