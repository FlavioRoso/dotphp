<?

namespace App\Models;

use App\Models\DAO\ExemplarDAO;

class Livro{

    private $id;
    private $nome;
    private $imagemCapa;
    private $diasEmprestimo;


    

    function setId($id){ $this->id = $id; }
    function getId(){ return $this->id; }

    function setNome($nome){ $this->nome = $nome; }
    function getNome(){ return $this->nome; }

    function setImagemCapa($imagemCapa){ $this->imagemCapa = $imagemCapa; }
    function getImagemCapa(){ return $this->imagemCapa; }

    function setDiasEmprestimo($diasEmprestimo){ $this->diasEmprestimo = $diasEmprestimo; }
    function getDiasEmprestimo(){ return $this->diasEmprestimo; }




   
}