<?

namespace App\Controller;

use Kender\TemplateModel\PhpTemplate;

class Produtos extends PhpTemplate{



    function index($param = []){

        
        $this->setData('titulo',$param['nome']);
        return $this->render("produtos/index.html");

    }
}