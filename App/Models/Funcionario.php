<?

namespace App\Models;

use App\Models\DAO\FuncionarioDAO;
class Funcionario
{
    private $id;
    private $nome;
    private $login;
    private $senha;
    private $papel;
    private $cep;
    private $numero;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $uf;
    private $complemento;
    private $ativo;
    private $imagemPerfil;

    const administrador = 1;
    const bibliotecario = 2;
    const auxiliar = 3;

    private const ARRAY_PAPEIS = [

        self::administrador => "Administrador",
        self::bibliotecario => "Bibliotecario",
        self::auxiliar => "Auxiliar"
    ];

    


    function setId($id){ $this->id = $id; }
    function getId(){ return $this->id; }

    function setNome($nome){ $this->nome = $nome; }
    function getNome(){ return $this->nome; }

    function setLogin($login){ $this->login = $login; }
    function getLogin(){ return $this->login; }

    function setSenha($senha){ $this->senha = $senha; }
    function getSenha(){ return $this->senha; }

    function setPapel($papel){ $this->papel = $papel; }
    function getPapel(){ return $this->papel; }

    function setCep($cep){ $this->cep = $cep; }
    function getCep(){ return $this->cep; }

    function setNumero($numero){ $this->numero = $numero; }
    function getNumero(){ return $this->numero; }

    function setLogradouro($logradouro){ $this->logradouro = $logradouro; }
    function getLogradouro(){ return $this->logradouro; }

    function setBairro($bairro){ $this->bairro = $bairro; }
    function getBairro(){ return $this->bairro; }

    function setCidade($cidade){ $this->cidade = $cidade; }
    function getCidade(){ return $this->cidade; }

    function setUf($uf){ $this->uf = $uf; }
    function getUf(){ return $this->uf; }

    function setComplemento($complemento){ $this->complemento = $complemento; }
    function getComplemento(){ return $this->complemento; }

    function setImagemPerfil($imagemPerfil){ $this->imagemPerfil = $imagemPerfil; }
    function getImagemPerfil(){ return $this->imagemPerfil; }
    function setAtivo($ativo){ $this->ativo = $ativo; }
    function getAtivo(){ return $this->ativo; }

    static function getArrayPapeis(){

        return self::ARRAY_PAPEIS;
    }

    static function criptografar($value)
    {
        return hash('sha256',$value);
    }

    function getEnderecoFormatado()
    {
        return $this->getLogradouro().', '.$this->getNumero().'<br> '.$this->getBairro().','.$this->getCidade().'<br> '.$this->getUf().', '.$this->getCep().', '.$this->getComplemento();
    }

    static function validaPrimeiroAcesso()
    {
        $funcinarioDAO=new FuncionarioDAO();
        return $funcinarioDAO->validaPrimeiroAcesso();
    }
    function validar(){

        $valido = [
            "sucesso" => true,
            "msg" => ""
        ];


        if($this->verificaLoginExistente($this->getLogin()))
        {
            $valido = [
                "sucesso" => false,
                "msg" => "Login de usuario já cadastrado!!"
            ];
        }

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
        $funcionarioDAO = new FuncionarioDAO();

        return $funcionarioDAO->gravar($this);
    }

    function editar()
    {
        $funcionarioDAO = new FuncionarioDAO();

        return $funcionarioDAO->editar($this);
    }

    function deletar()
    {
        $funcionarioDAO = new FuncionarioDAO();

        return $funcionarioDAO->deletar($this->id);
    }
    static function buscar($id)
    {
        $funcionarioDAO = new FuncionarioDAO();

        return $funcionarioDAO->buscar($id);
    }

    static function buscarLogin($email,$senha)
    {
        $funcionarioDAO = new FuncionarioDAO();

        return $funcionarioDAO->buscarLogin($email,$senha);
    }

    static function verificaLoginExistente($email)
    {
        $funcionarioDAO = new FuncionarioDAO();

        return $funcionarioDAO->verificaLoginExistente($email);
    }

    static function listaTodos()
    {
        $funcionarioDAO = new FuncionarioDAO();

        return $funcionarioDAO->listaTodos();
    }


}