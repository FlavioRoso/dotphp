<?

namespace Kender\Bootstrap;
use Kender\Routing\Route;
use Kender\Config;

class Bootstrap{

    protected  $routes;




    protected function add($url)
    {

        $this->routes [] = new Route($url);
        
        return end($this->routes);
    }

    public function getRoute($url)
    {
        $route = array_filter($this->routes,function($route) use($url){
            return $route->getUrl() == $url;
        });
        return end($route);
    }

    public function findRoute(String $requestURL)
    {
    
        $routeFind = null;
        
        if($this->routes)
        {
            $routes = $this->routes;
            reset($routes);
            while( ($route = current($routes)) && !$routeFind)
            {
               
                if($route->matchUrl($requestURL))
                {
                    $routeFind = $route;
                }
                next($routes);
            }
        }

        if($routeFind)
        {
            $routeFind->setDataFromUrl($requestURL);
        }
        else
        {
           $routeFind = $this->getRoute("/404");
        }
            
      
        return $routeFind;
        

    }
    
   

    

    

    public static function getRequestUrl()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = str_replace(Config::ROOT_DIR,"/",$url);
        return $url;
    }
    
}