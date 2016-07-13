<?php

class Request
{
	public $method;
	public $parameters;
	
	function __construct()
	{
		$this->method     = $_SERVER['REQUEST_METHOD'];
		$this->parameters = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
	}
	function popNextParameter() 
	{
		return array_shift($this->parameters);
	}
	
}