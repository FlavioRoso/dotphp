<?

namespace App\Models;

use App\Models\DAO\CategoriaDAO;

class Categoria{

    private $id;
    private $categoriaPaiId;
    private $categoriaPai;
    private $nome;
    


    function __construct($id = null, $nome = null,$categoriaPaiId = null )
    {
        $this->id = $id;
        $this->categoriaPaiId = $categoriaPaiId;
        $this->nome = $nome;
    }

    function setId($id){ $this->id = $id; }
    function getId(){ return $this->id; }

    function setCategoriaPaiId($categoriaPaiId){ $this->categoriaPaiId = $categoriaPaiId; }
    function getCategoriaPaiId(){ return $this->categoriaPaiId; }

    function setCategoriaPai($categoriaPai){ $this->categoriaPai = $categoriaPai; }
    function getCategoriaPai(){ return $this->categoriaPai; }

    function setNome($nome){ $this->nome = $nome; }
    function getNome(){ return $this->nome; }


    function validar(){

        $valido = [
            "sucesso" => true,
            "msg" => ""
        ];

        if(!$this->nome)
        {
            $valido = [
                "sucesso" => false,
                "msg" => "Nome deve ser preenchido!!"
            ];
        }

        return $valido;
    }

    function gravar()
    {
        
        $categoriaDAO = new CategoriaDAO();

        return $categoriaDAO->gravar($this);


    }

    function editar()
    {
        
        $categoriaDAO = new CategoriaDAO();

        return $categoriaDAO->editar($this);


    }

    function deletar()
    {
        
        $categoriaDAO = new CategoriaDAO();

        return $categoriaDAO->deletar($this->id);


    }

    static function  listaTodos()
    {
        
        $categoriaDAO = new CategoriaDAO();

        return $categoriaDAO->listaTodos();


    }
    static function  listaTodosComCategoriaPai()
    {
        
        $categoriaDAO = new CategoriaDAO();

        return $categoriaDAO->listaTodosComCategoriaPai();


    }
    static function buscar($id)
    {
        
        $categoriaDAO = new CategoriaDAO();

        return $categoriaDAO->buscar($id);


    }

    


   
}