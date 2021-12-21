<?

namespace App\Models\DAO;

use App\Models\Livro;
use App\Models\Exemplar;
use App\Controllers\DB\DbFactory;

class ExemplarDAO
{


    function map(Exemplar $exemplar, $item)
    {
        $exemplar->setId($item["id"]);
        $exemplar->setLivroId($item["livro_id"]);
        $exemplar->setDoacaoId($item["doacao_id"]);
        $exemplar->setISBN($item["isbn"]);
        $exemplar->setLocalizacao($item["localizacao"]);
        $exemplar->setDataCadastro($item["dataCadastro"]);
        $exemplar->setStatus($item["status"]);
    }

    function buscar($id)
    {


        $banco = DbFactory::getInstance();
        $exemplar = null;
        $sql = "SELECT 
                    ex.id,
                    ex.livro_id,
                    ex.doacao_id,
                    ex.isbn,
                    ex.localizacao,
                    ex.dataCadastro,
                    ex.status,
                    li.nome,
                    li.imgCapa,
                    li.quantidadeDiasEmprestimo
                FROM exemplar ex
                INNER JOIN livro li on ex.livro_id = li.id
                WHERE ex.id = ?";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$id]);

        if ($result) {
            $item = $result[0];
            $exemplar = new Exemplar();
            $this->map($exemplar,$item);
            
            $livro = new Livro();
            $livro->setNome($item['nome']);
            $livro->setImagemCapa($item['imgCapa']);
            $livro->setDiasEmprestimo($item['quantidadeDiasEmprestimo']);

            $exemplar->setLivro($livro);
        } else {
            return false;
        }

        return $exemplar;
    }

    function buscarQuantidadeExemplaresDisponiveisPorLivro($livro_id)
    {
        $banco = DbFactory::getInstance();

        $sql = "SELECT (

                    COUNT(ex.livro_id) - 
                    (SELECT COUNT(r.livro_id) FROM reserva r WHERE r.livro_id = ? AND r.dataLimite > CURDATE()) 
                    
                
                ) quantidadeDisponivel 
                FROM exemplar ex  
            
                WHERE ex.livro_id = ? AND ex.id NOT IN ( SELECT exemplar_id FROM emprestimo em WHERE exemplar_id = ex.id AND em.ativo)";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$livro_id,$livro_id]);

        if ($result) {
            return $result[0]["quantidadeDisponivel"];
        } else {
            return false;
        }
    }

  
    function buscarPorISBN($isbn)
    {
        $banco = DbFactory::getInstance();
        $exemplar = null;
        $sql = "SELECT  
                    ex.id,
                    ex.livro_id,
                    ex.doacao_id,
                    ex.isbn,
                    ex.localizacao,
                    ex.dataCadastro,
                    ex.status,
                    li.nome,
                    li.imgCapa,
                    li.quantidadeDiasEmprestimo
                FROM exemplar ex
                INNER JOIN livro li on ex.livro_id = li.id
                WHERE isbn = ?
                AND ex.id NOT IN(SELECT exemplar_id FROM emprestimo WHERE exemplar_id = ex.id AND ativo IS TRUE)
                AND ex.id NOT IN(SELECT exemplar_id FROM baixa_exemplar WHERE exemplar_id = ex.id)
                ";

        $banco->setComandoSQL($sql);
        $result = $banco->executeQuery([$isbn]);

        if ($result) {
            $item = $result[0];
            $exemplar = new Exemplar();
            $this->map($exemplar,$item);
            
            $livro = new Livro();
            $livro->setNome($item['nome']);
            $livro->setImagemCapa($item['imgCapa']);
            $livro->setDiasEmprestimo($item['quantidadeDiasEmprestimo']);

            $exemplar->setLivro($livro);


        } else {
            return false;
        }

        return $exemplar;
    }
}
