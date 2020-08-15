<?php


	
namespace Kender;

class App {

	public static function autoLoader()
	{
		include('Loader/Psr4/Psr4AutoloaderClass.php');
		include('Config.php');

		//AUTO LOADER PSR4
		$loader = new \Kernel\Psr4\Psr4AutoloaderClass();

		//KERNEL NAMESPACE
		$loader->addNamespace("Kender",__DIR__);
		//APLICATION NAMESPACE
		$loader->addNamespace( Config::APLICATION_NAME , Config::APLICATION_PATH );
		$loader->register();

		//SESSION
		session_start();

	}



	static function run() {

		//self::autoLoader();

		try
		{
			$router = new \App\Router\RouterConfig();
			$url = $router->getRequestUrl();
			$route = $router->findRoute($url);
	
			
			if($route)
			{
				$route->execute();
			}
			else
			{
				
				
				

			}
			
				
			
				

		}
		catch(\Exception $e)
		{

		}
	
		
	

	}

}


?>