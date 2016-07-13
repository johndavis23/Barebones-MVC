<?php
/*
 * A barebones login controller.
 * 
 * index.php/Login/Index or index.php/Login/ 	Suplies a form for login and registration 
 * 												If logged in instead supplies a list of users
 * index.php/Login/Register 					Processes the register form
 * index.php/Login/Logout 						Logs the user out
 * index.php/Login/Login 						Processes a login form
 * 
 */
include_once "Classes/Controller.php";
include_once "Models/UserModel.php";
include_once "Classes/Login.php";
include_once "Classes/View.php";
include_once "Util/UrlUtils.php";

class LoginController extends Controller
{
	protected $login;
	protected $validActions = ["Index","Login", "Register","Logout"];
	
	function __construct()
	{
		$this->view     = new View();
		$this->login    = new Login();
	}
	
	//Our Pages
	function Index()
	{
		if($this->login->loggedIn())
		{
			$um = new UserModel();
			$users = $um->read([]); 
			//or $um->readAll();
			//You can use something like this if you'd like to page these results: 
			//$users = $um->readOffset([],  15, 0);

			$this->view->render("Users/List", ["users"=>$users]);
			
			return;
		}
		else 
		{
			//display forms instead
			$this->view->render("Forms/Login/Login",[]);
			$this->view->render("Forms/Login/Register",[]);
			return;
		}
	}
	
	function Login()
	{
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		if($this->login->login($username, $password))
		{
			$_SESSION['username'] = $username;
			$this->view->redirectController("Login");
		}
		else 
		{
			$this->login->logout();
			$this->view->redirectController("Login");
		}
		
	}
	
	function Logout()
	{
		$this->login->logout();
		$this->view->redirectController("Login");
	}
	
	function Register()
	{
		
		$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		$email 	  = filter_var($_POST['email'],    FILTER_SANITIZE_EMAIL);
		
		$um = new UserModel();
		$um->registerUser($username, $password, $email);
		
		$this->view->redirectController("Login");
	}
	
	
}
