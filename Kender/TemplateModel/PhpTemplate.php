<?

namespace Kender\TemplateModel;
use Kender\Config;
class PhpTemplate{

    

    private $data;


    function getData($index)
    {
        
        return isset($this->data[$index]) ? $this->data[$index] : false ;
    }

    function setData($index,$data)
    {
        $this->data[$index] = $data;
    }

    function include(String $dir)
    {
        include(Config::PUBLIC_PATH . $dir);
    }


    function render(String $dir,$data = null)
    {
        $this->data = isset($data) ? $data : $this->data;

        ob_start();
        $this->include($dir);
        $string = ob_get_contents();
        
        ob_end_clean();
     

        return $string;

    }



}