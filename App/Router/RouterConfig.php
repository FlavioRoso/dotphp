<?

namespace App\Router;

use App\Models\Funcionario;
use App\Controllers\Auth\Auth;
use Enkel\Bootstrap\Bootstrap;

class RouterConfig extends Bootstrap
{

      function __construct()
      {

            // @home
            $this->add("/")
                  ->setController("\App\Controllers\LoginController")
                  ->setMethod("index");

            // @home
            $this->add("/auth")
                  ->setController("\App\Controllers\LoginController")
                  ->setMethod("auth");

            // @home
            $this->add("/logout")
                  ->setController("\App\Controllers\LoginController")
                  ->setMethod("logout");

            //@Configuração Inicial
            $this->group("/configuracao",function(){
                  $this->add("")
                       ->setController("\App\Controllers\ConfiguracaoController")
                       ->setMethod("index");
                  $this->add("/novo")
                        ->setController("App\Controllers\ConfiguracaoController")
                        ->setMethod("novo");
                  
            });

            // @dashboard
            $this->add("/dashboard")
                  ->setController("\App\Controllers\DashBoardController")
                  ->setMethod("index");


            // @categoria
            $this->group("/categoria", function () {

                  $this->add("")
                        ->setController("\App\Controllers\CategoriaController")
                        ->setMethod("index");

                  // @nova categoria
                  $this->add("/novo")
                        ->setController("\App\Controllers\CategoriaController")
                        ->setMethod("novo");

                  // @editar categoria
                  $this->add("/editar/@{id}")
                        ->setController("\App\Controllers\CategoriaController")
                        ->setMethod("editar");

                  // @deletar categoria
                  $this->add("/deletar/@{id}")
                        ->setController("\App\Controllers\CategoriaController")
                        ->setMethod("deletar");
            });


            //Cliente
            $this->group("/cliente", function () {
                  $this->add("")
                        ->setController("\App\Controllers\ClienteController")
                        ->setMethod("index");

                  // @novo Cliente
                  $this->add("/novo")
                        ->setController("\App\Controllers\ClienteController")
                        ->setMethod("novo");

                  // @editar Cliente
                  $this->add("/editar/@{id}")
                        ->setController("\App\Controllers\ClienteController")
                        ->setMethod("editar");

                  // @deletar Cliente
                  $this->add("/deletar/@{id}")
                        ->setController("\App\Controllers\ClienteController")
                        ->setMethod("deletar");
            });


            if (Auth::validaPermissao([Funcionario::administrador])) {

                  // parametrizacao
                  $this->add("/parametrizacao")
                        ->setController("\App\Controllers\ParametrizacaoController")
                        ->setMethod("index");

                  // @funcionario
                  $this->group("/funcionario", function () {

                        $this->add("")
                              ->setController("\App\Controllers\FuncionarioController")
                              ->setMethod("index");

                        // @nova funcionario
                        $this->add("/novo")
                              ->setController("\App\Controllers\FuncionarioController")
                              ->setMethod("novo");

                        // @editar funcionario
                        $this->add("/editar/@{id}")
                              ->setController("\App\Controllers\FuncionarioController")
                              ->setMethod("editar");

                        // @deletar funcionario
                        $this->add("/deletar/@{id}")
                              ->setController("\App\Controllers\FuncionarioController")
                              ->setMethod("deletar");
                  });
            }



            // @emprestimo
            $this->group("/emprestimo", function () {

                  $this->add("")
                        ->setController("\App\Controllers\EmprestimoController")
                        ->setMethod("index");

                  $this->add("/cliente/@{cpf}")
                        ->setController("\App\Controllers\EmprestimoController")
                        ->setMethod("cliente");

                  $this->add("/novo/@{cliente_id}")
                        ->setController("\App\Controllers\EmprestimoController")
                        ->setMethod("novo");

                  $this->add("/renovar/@{id}")
                        ->setController("\App\Controllers\EmprestimoController")
                        ->setMethod("renovar");
                        
                  $this->add("/situacao/@{id}")
                        ->setController("\App\Controllers\EmprestimoController")
                        ->setMethod("situacao");
            });

            // @situacao
            $this->group("/situacao", function () {

                  $this->add("")
                        ->setController("\App\Controllers\SituacaoController")
                        ->setMethod("index");

                  $this->add("/cliente/@{cpf}")
                        ->setController("\App\Controllers\SituacaoController")
                        ->setMethod("cliente");

                  $this->add("/regularizar/@{id}")
                        ->setController("\App\Controllers\SituacaoController")
                        ->setMethod("regularizar");
            });

            $this->group("/api", function () {

                  // @exemplar
                  $this->group("/exemplar", function () {

                        $this->add("/buscar/@{isbn}")
                              ->setController("\App\Controllers\ExemplarController")
                              ->setMethod("buscar");
                  });

                  $this->add("/emprestimo/cadastrar/@{cliente_id}")
                              ->setController("\App\Controllers\EmprestimoController")
                              ->setMethod("cadastrar");
            });

            // @404
            $this->add("/404")
                  ->setController("\App\Controllers\NotFoundController")
                  ->setMethod("index");
      }
}
