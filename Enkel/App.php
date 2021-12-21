<?php


	
namespace Enkel;

use Enkel\Http\HttpHelper;

class App {


	static function run() {

		try
		{
			$router = new \App\Router\RouterConfig();
			$url = HttpHelper::getRequestUrl();
			$route = $router->findRoute($url);
	
			if($route)
			{
				$route->execute();
			}


		}
		catch(\Exception $e)
		{

		}
	
		
	

	}

}


?>