<?php

//The simplest View that's not an include.
include_once("Utils/UrlUtils.php");

class ViewException extends Exception{}

class View
{
	
	function __construct()
	{
		
	}
	
	function redirect($url)
	{
		 header("Location: $url");
	}
	function redirectController($controller)
	{
		$url  = UrlUtils::getControllerUrl( $controller);
		header("Location: $url");
	}
	function render( $view, array $data)
	{
		if(file_exists("Views/$view.php"))
		{
			//create variables for each data element passed to us
			foreach($data as $key=>$value)
			{
				$$key = $value;
			}
			
			include "Views/$view.php";
		}
		else
		{
			throw new ViewException("View Does Not Exist");
		}	

	}
	
}
