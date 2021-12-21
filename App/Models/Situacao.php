<?

namespace App\Models;

use App\Models\DAO\SituacaoDAO;

class Situacao{

    private $id;
    private $emprestimo_id;
    private $funcionario_id;
    private $cliente_id;
    private $tipo;
    private $descricao;
    private $diasAtraso;
    private $dataFinalBloqueio;


    private const TIPOS = [
        1 => "bloqueado",
        2 => "multa",
        3 => "doacao"
    ];

    function getArrayTipos()
    {
        return self::TIPOS;
    }

    function setId($id){ $this->id = $id; }
    function getId(){ return $this->id; }

    function setEmprestimoId($emprestimo_id){ $this->emprestimo_id = $emprestimo_id; }
    function getEmprestimoId(){ return $this->emprestimo_id; }

    function setFuncionarioId($funcionario_id){ $this->funcionario_id = $funcionario_id; }
    function getFuncionarioId(){ return $this->funcionario_id; }

    function setClienteId($cliente_id){ $this->cliente_id = $cliente_id; }
    function getClienteId(){ return $this->cliente_id; }

    function setTipo($tipo){ $this->tipo = $tipo; }
    function getTipo()
    {
        if($this->tipo == 1)
            return "bloqueado";
        else if($this->tipo == 2)
            return "multa";
        else if($this->tipo == 3)
            return "doacao";
    }

    function setDescricao($descricao){ $this->descricao = $descricao; }
    function getDescricao(){ return $this->descricao; }
    
    function setDiasAtraso($diasAtraso){ $this->diasAtraso = $diasAtraso; }
    function getDiasAtraso(){ return $this->diasAtraso; }
    
    function setDataFinalBloqueio($dataFinalBloqueio){ $this->dataFinalBloqueio = $dataFinalBloqueio; }
    function getDataFinalBloqueio(){ return $this->dataFinalBloqueio; }
    
  

    function gravar()
    {
        $situacaoDao = new SituacaoDAO();

        return $situacaoDao->gravar($this);
    }

    function editar(){
        $situacaoDao = new SituacaoDAO();

        return $situacaoDao->editar($this);
    }

    static function buscar($situacao_id){
        $situacaoDao = new SituacaoDAO();

        return $situacaoDao->buscar($situacao_id);
    }

    static function buscarSitacaoAtivaCliente($cliente_id){
        $situacaoDao = new SituacaoDAO();

        return $situacaoDao->buscarSitacaoAtivaCliente($cliente_id);
    }

    static function buscarEmprestimosCliente($cliente_id)
    {
        $emprestimoDAO = new SituacaoDAO();

        return $emprestimoDAO->buscarEmprestimosCliente($cliente_id);
    }

    static function valorMulta(){
        $situacaoDao = new SituacaoDAO();

        return $situacaoDao->valorMultaDiaria();
    }

    static function buscarPorEmprestimo($emprestimo_id){
        $situacaoDao = new SituacaoDAO();

        return $situacaoDao->buscarPorEmprestimo($emprestimo_id);
    }
}