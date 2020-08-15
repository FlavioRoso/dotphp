<?

namespace App\Controller;
use Kender\TemplateModel\TwigTemplate;

class Home extends TwigTemplate{



    function index()
    {
        
        return $this->render("index/index.twig",[
            'titulo' => "Bem vindo a um site em MVC novo em folha",
        ]);
    }
    
    function contato()
    {
        return "to em contato";
    }

    function error404()
    {

        return "Ops, essa pagina não existe";
    }
}