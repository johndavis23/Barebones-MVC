<?php 

include_once("Classes/Request.php");

class SiteController
{
	private $method;
	private $parameters;
	
	function __construct()
	{
		
	}
	
	function route(Request $request)
	{
		
		$controller = array_shift($request->parameters);
		
		$controller = filter_var($controller, FILTER_SANITIZE_STRING);
			
		if(empty($controller)) $controller = "Index";
		
		$controller .= "Controller";
		$controllerPath = "Controllers/$controller.php";
		
		if(file_exists($controllerPath))
		{
			include $controllerPath; 
		}
		else
		{
			throw new InvalidArgumentException("Controller Not Valid.");
		}
		
		$controller = new $controller();
		$controller->run($request);
		
		return;
	}
}
