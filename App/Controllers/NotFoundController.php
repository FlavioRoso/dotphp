<?

namespace App\Controllers;

use App\Models\Funcionario;
use Enkel\Controllers\Message;
use Enkel\Controllers\Controller;
use Enkel\Controllers\Session;

class NotFoundController extends Controller{



    function index()
    {
        http_response_code(404);
        return "Opss, essa pagina não existe";
    }

  


   
}