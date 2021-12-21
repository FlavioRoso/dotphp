<?

namespace App\Models;

use App\Models\DAO\ClienteDAO;
class Cliente
{

    private $id;
    private $nome;
    private $cpf;
    private $telefone;
    private $celular;
    private $email;
    private $cep;
    private $logradouro;
    private $uf;
    private $cidade;
    private $bairro;
    private $numero;
    private $complemento;
    
    function __construct($id=null, $nome=null, $cpf=null, $telefone=null, $celular=null, $email=null, $cep=null, $logradouro=null, $uf=null, $cidade=null, $bairro=null, $numero=null, $complemento=null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->celular = $celular;
        $this->email = $email;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->uf = $uf;
        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->complemento = $complemento;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCelular() {
        return $this->celular;
    }

    function getEmail() {
        return $this->email;
    }

    function getCep() {
        return $this->cep;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getUf() {
        return $this->uf;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    static function listaTodos()
    {
        
        $clienteDAO = new ClienteDAO();

        return $clienteDAO->listaTodos();


    }

    function validar(){

        $valido = [
            "sucesso" => true,
            "msg" => ""
        ];

        // if(!$this->nome)
        // {
        //     $valido = [
        //         "sucesso" => false,
        //         "msg" => "Nome deve ser preenchido!!"
        //     ];
        // }
        // else if()

        return $valido;
    }

    function gravar()
    {
        
        $clienteDAO = new ClienteDAO();

        return $clienteDAO->gravar($this);


    }

    function editar()
    {
        
        $clienteDAO = new ClienteDAO();

        return $clienteDAO->editar($this);


    }

    static function buscar($id)
    {
        
        $clienteDAO = new ClienteDAO();

        return $clienteDAO->buscar($id);
    }

    static function buscarPorCpf($cpf)
    {
        
        $clienteDAO = new ClienteDAO();

        return $clienteDAO->buscarPorCpf($cpf);
    }

    function deletar()
    {
        
        $clienteDAO = new ClienteDAO();

        return $clienteDAO->deletar($this->id);


    }

    function existePendencia()
    {
        $clienteDAO = new ClienteDAO();

        return $clienteDAO->verificaPendencia($this->id);
    }
}

?>