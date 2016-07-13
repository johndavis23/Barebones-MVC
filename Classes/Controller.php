<?php
include_once('Classes/Request.php');
include_once('Classes/View.php');

class Controller
{
	protected $validActions = ["Index"];
	protected $view;
	function __construct()
	{
		$this->view = new View();
	}
	
	function run(Request $request)
	{
		$action = $request->popNextParameter();
		if(in_array($action, $this->validActions)) //its not in this array?!
		{
			call_user_func([$this, $action]);
			return;
		}
		else
		{
			call_user_func([$this, $this->validActions[0]]);//fail softly instead and supply default action. 
			return;
		}
	}
	public function Index()
	{
		
	}
	public function registerAction($action)
	{
		$this->validActions[] = $action;
	}
}
