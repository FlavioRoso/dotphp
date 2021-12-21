<?

namespace Enkel\Bootstrap;
use Enkel\Routing\Route;
use App\Config;
class Bootstrap{

    protected  $routes;
    protected  $activeGrups = [];

    private function getGroupUrl($url)
    {
        $groupUrl = "";
        foreach($this->activeGrups as $group)
        {
            $groupUrl .= $group; 
        }

        return $groupUrl.$url;
    }

    protected function group($base,$function)
    {
        $this->activeGrups [] = $base;
        $function();
        array_pop($this->activeGrups);
    }

    protected function add($url)
    {

        $this->routes [] = new Route($this->getGroupUrl($url));
        
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
}