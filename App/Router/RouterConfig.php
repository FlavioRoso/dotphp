<?

namespace App\Router;

use Kender\Bootstrap\Bootstrap;

class RouterConfig extends Bootstrap{

   function __construct()
   {

         // @HOME
        $this->add("/")
        ->setController("\App\Controller\Home")
        ->setMethod("index");


        // @HOME/CONTATO
        $this->add("/contato")
        ->setController("\App\Controller\Home")
        ->setMethod("contato");


         //@PRODUTOS
        $this->add("/produtos/@{id}/@{nome}")
        ->setController("\App\Controller\Produtos")
        ->setMethod("index");

         // @404
         $this->add("/404")
         ->setController("\App\Controller\Home")
         ->setMethod("error404");

      
        
   }

    
}
