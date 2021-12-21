<?

namespace App\Controllers\Base;

use Enkel\Controllers\Controller;
use Enkel\Controllers\Session;

class BaseController extends Controller
{

    function __construct()
    {
        $login = Session::get("login");
        if(!$login)
        {
            $this->redirect("");
        }

        $this->setData("login",$login);
        
        parent::__construct();

    }
    
}
