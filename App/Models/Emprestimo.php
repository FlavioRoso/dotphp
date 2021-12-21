<?

namespace App\Models;

use App\Models\DAO\EmprestimoDAO;
use App\Models\DAO\SituacaoDAO;
use DateTime;
class Emprestimo{

    private $id;
    private $cliente_id;
    private $funcionario_id;
    private $exemplar_id;
    private $dataLimite;
    private $dataCadastro;
    private $ativo;
    private $exemplar;
    private $quantidadeRenovacoes;



    function setId($id){ $this->id = $id; }
    function getId(){ return $this->id; }

    function setClienteId($cliente_id){ $this->cliente_id = $cliente_id; }
    function getClienteId(){ return $this->cliente_id; }

    function setFuncionarioId($funcionario_id){ $this->funcionario_id = $funcionario_id; }
    function getFuncionarioId(){ return $this->funcionario_id; }

    function setExemplarId($exemplar_id){ $this->exemplar_id = $exemplar_id; }
    function getExemplarId(){ return $this->exemplar_id; }

    function setDataLimite($dataLimite){ $this->dataLimite = $dataLimite; }
    function getDataLimite(){ return $this->dataLimite; }
    
    function setDataCadastro($dataCadastro){ $this->dataCadastro = $dataCadastro; }
    function getDataCadastro(){ return $this->dataCadastro; }

    function setAtivo($ativo){ $this->ativo = $ativo; }
    function getAtivo(){ return $this->ativo; }

    function setExemplar($exemplar){ $this->exemplar = $exemplar; }
    function getExemplar(){ return $this->exemplar; }

    function setQuantidadeRenovacoes($quantidadeRenovacoes){ $this->quantidadeRenovacoes = $quantidadeRenovacoes; }
    function getQuantidadeRenovacoes(){ return $this->quantidadeRenovacoes; }

    function incrementaQuantidadeRenovacoes()
    {
        $this->quantidadeRenovacoes += 1;
    }
    function incrementaDiasDataLimite($dias){ 
        $this->dataLimite = date('Y-m-d', strtotime($this->dataLimite . ' + ' . $dias . ' weekdays'));
    }

    function getAtrasado()
    {
        $dataAtual = new DateTime();
        $dataLimite = new DateTime($this->dataLimite);

        $atrasado = $dataLimite->format('Y-m-d') <  $dataAtual->format('Y-m-d');

        return $atrasado && $this->ativo;
    }

    function gravar()
    {
        $emprestimoDAO = new EmprestimoDAO();

        return $emprestimoDAO->gravar($this);
    }

   
    function editar(){
        $emprestimoDAO = new EmprestimoDAO();

        return $emprestimoDAO->editar($this);
    }

    static function buscar($id){
        $emprestimoDAO = new EmprestimoDAO();

        return $emprestimoDAO->buscar($id);
    }

    static function buscarEmprestimosCliente($cliente_id)
    {
        $emprestimoDAO = new EmprestimoDAO();

        return $emprestimoDAO->buscarEmprestimosCliente($cliente_id);
    }

    static function buscarQuantidadeEmprestimoAtivosCliente($cliente_id)
    {
        $exemplarDao = new EmprestimoDAO();

        return $exemplarDao->buscarQuantidadeEmprestimoAtivosCliente($cliente_id);
    }


   
}