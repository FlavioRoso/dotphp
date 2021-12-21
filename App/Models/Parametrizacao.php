<?

namespace App\Models;

use App\Models\DAO\ParametrizacaoDAO;

class Parametrizacao{

    private $id;
    private $multaDiaAtraso;
    private $limiteEmprestimoSimultaneos;
    private $razaoSocial;
    private $logo;
    


    function __construct($id = null, $multaDiaAtraso = 0,$limiteEmprestimoSimultaneos = 0,  $razaoSocial = null, $logo = null)
    {
        $this->id = $id;
        $this->multaDiaAtraso = $multaDiaAtraso;
        $this->limiteEmprestimoSimultaneos = $limiteEmprestimoSimultaneos;
        $this->razaoSocial = $razaoSocial;
        $this->logo = $logo;
    }

    function setId($id){ $this->id = $id; }
    function getId(){ return $this->id; }

    function setMultaDiaAtraso($multaDiaAtraso){ $this->multaDiaAtraso = $multaDiaAtraso; }
    function getMultaDiaAtraso(){ return $this->multaDiaAtraso; }

    function setLimiteEmprestimoSimultaneos($limiteEmprestimoSimultaneos){ $this->limiteEmprestimoSimultaneos = $limiteEmprestimoSimultaneos; }
    function getLimiteEmprestimoSimultaneos(){ return $this->limiteEmprestimoSimultaneos; }

    function setRazaoSocial($razaoSocial){ $this->razaoSocial = $razaoSocial; }
    function getRazaoSocial(){ return $this->razaoSocial; }

    function setLogo($logo){ $this->logo = $logo; }
    function getLogo(){ return $this->logo; }

    function validar(){

        $valido = [
            "sucesso" => true,
            "msg" => ""
        ];

        if(!$this->multaDiaAtraso)
        {
            $valido = [
                "sucesso" => false,
                "msg" => "Multa dias deve ser preenchido!!"
            ];
        }

        if(!$this->limiteEmprestimoSimultaneos)
        {
            $valido = [
                "sucesso" => false,
                "msg" => "Limete de emprestimo deve ser preenchido!!"
            ];
        }

        if(!$this->razaoSocial)
        {
            $valido = [
                "sucesso" => false,
                "msg" => "Razão Social deve ser preenchido!!"
            ];
        }

        return $valido;
    }

    function gravar()
    {
        
        $parametrizacaoDAO = new ParametrizacaoDAO();

        return $parametrizacaoDAO->gravar($this);

    }

    static function buscar()
    {
        
        $parametrizacaoDAO = new ParametrizacaoDAO();

        return $parametrizacaoDAO->buscar();

    }

    static function  listaTodos()
    {
        
        $parametrizacaoDAO = new ParametrizacaoDAO();

        return $parametrizacaoDAO->listaTodos();

    }
    
}