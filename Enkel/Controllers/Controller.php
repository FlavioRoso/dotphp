<?

namespace Enkel\Controllers;

use Enkel\Http\HttpHelper;
use App\Config;
class Controller{

    

    private $data;
    private $viewDir;
    private $layout;
    private $viewData;
    private $viewContent;
    private $section;

    

    function __construct()
    {
        $this->viewData = [];
        $this->section = [];


    }

    protected function section($name,$value)
    {
        $this->section[$name] = $value;
    }

    protected function renderSection($name,$required = true)
    {
        if(isset($this->section[$name]))
        {
            return $this->section[$name];
        }
       
        
    }


    protected function getData($index)
    {
        
        return isset($this->data[$index]) ? $this->data[$index] : false ;
    }

    protected function setData($index,$data)
    {
        $this->data[$index] = $data;
    }


 
    protected function includeView(String $dir)
    {
        include(BASEPATH.Config::VIEW_PATH."/". $dir);
    }
    

    private function renderBody()
    {
        
        echo $this->viewContent;
        
    }

   

    protected function redirect($url)
    {
        header("Location: ". HttpHelper::getRootDirPath() .$url);
        die();
    }

    private function solveUrlImport($render)
    {
        $render = str_replace("~/",HttpHelper::getRootDirPath().Config::PUBLIC_PATH,$render);
        $render = str_replace("@/",HttpHelper::getRootDirPath(),$render);

        return $render;
    }

    private function solveViewRender()
    {

        ob_start();
        $this->includeView($this->viewDir);
        $this->viewContent = ob_get_contents();
        
        ob_end_clean();
    }

    private function solveLayoutRender($dir)
    {
        $this->viewDir = $dir;
        //Get _viewStart
        $this->includeView("_ViewStart.php");
        $this->solveViewRender();

        ob_start();

        if($this->layout)
        {
            $this->includeView($this->layout. ".php");
        }
        else 
        {
            $this->renderBody();
        }

        $render = ob_get_contents();
        
        ob_end_clean();

       return $this->solveUrlImport($render);
    }




    protected function render(String $dir= null)
    {

        if(!$dir)
        {
            $dir = str_replace("Controller","",$this->controlerName) ."/". $this->methodName . ".php";
        }

        return $this->solveLayoutRender($dir);

    }

   
 

    // function render($data = null)
    // {

    //     return render(String $dir,$data);
    // }

 



}