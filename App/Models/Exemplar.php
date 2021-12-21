<?

namespace App\Models;

use App\Models\DAO\ExemplarDAO;

class Exemplar{

    private $id;
    private $livro_id;
    private $doacao_id;
    private $isbn;
    private $localizacao;
    private $dataCadastro;
    private $status;

    private $livro;


    

    function setId($id){ $this->id = $id; }
    function getId(){ return $this->id; }

    function setLivroId($livro_id){ $this->livro_id = $livro_id; }
    function getLivroId(){ return $this->livro_id; }

    function setDoacaoId($doacao_id){ $this->doacao_id = $doacao_id; }
    function getFuncionarioId(){ return $this->doacao_id; }

    function setISBN($isbn){ $this->isbn = $isbn; }
    function getISBN(){ return $this->isbn; }

    function setLocalizacao($localizacao){ $this->localizacao = $localizacao; }
    function getLocalizacao(){ return $this->localizacao; }

    function setDataCadastro($dataCadastro){ $this->dataCadastro = $dataCadastro; }
    function getDataCadastro(){ return $this->dataCadastro; }

    function setStatus($status){ $this->status = $status; }
    function getStatus(){ return $this->status; }

    function setLivro($livro){ $this->livro = $livro; }
    function getLivro(){ return $this->livro; }

    static function buscarPorISBN($isbn)
    {
        $exemplarDao = new ExemplarDAO();

        return $exemplarDao->buscarPorISBN($isbn);
    }

  

    static function buscar($id)
    {
        $exemplarDao = new ExemplarDAO();

        return $exemplarDao->buscar($id);
    }

    static function buscarQuantidadeExemplaresDisponiveisPorLivro($livro_id)
    {
        $exemplarDao = new ExemplarDAO();

        return $exemplarDao->buscarQuantidadeExemplaresDisponiveisPorLivro($livro_id);
    }
   
}