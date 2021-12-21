<?

namespace App\Controllers;

use App\Controllers\Base\BaseController;
use App\Models\Exemplar;

class ExemplarController extends BaseController{




    function buscar($param)
    {
        $retorno = [
            "sucesso" => false,
            "msg" => ""
        ];

        $exemplar = Exemplar::buscarPorISBN($param['isbn']);
        if($exemplar)
        {
            if($exemplar->buscarQuantidadeExemplaresDisponiveisPorLivro($exemplar->getLivroId()) > 0)
            {

            
                $retorno["exemplar"] = [
                    "id" => $exemplar->getId(),
                    "nome_livro" => $exemplar->getLivro()->getNome(),
                    "imagemCapa" => $exemplar->getLivro()->getImagemCapa(),
                    "livro_id" => $exemplar->getLivroId(),
                    "isbn" => $exemplar->getISBN(),
                ];

                $retorno["sucesso"] = "true";
            }
            else
            {
                $retorno["msg"] = "Exemplar indisponível, livro em reserva!!!";
            }

        }
        else
        {
            $retorno["msg"] = "ISBN indisponível!!";
        }

        return json_encode($retorno);
    }

}