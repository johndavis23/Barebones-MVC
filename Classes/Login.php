<?php

include_once("Models/UserModel.php");
class Login
{
	function __construct()
	{
		if (session_status() === PHP_SESSION_NONE)
		{
			session_start();
		}
	}
	//Our Logic. Perhaps this should be its own class.
	public function login( $username,  $password)
	{
		session_regenerate_id(); //attempt to stop session fixation attack
		
		if(!$this->loggedIn())
		{
			$um = new UserModel();
			if($um->userExistsWithPlainPassword( $username,  $password))
			{
				
				$_SESSION['username']   = $this->username;
				
				return true;
			}
			else
			{
				$_SESSION['error'][] = "Authentication Error";
				return false;
			}
		}
		
		return false;
	}
	
	public function loggedIn()
	{
		return isset($_SESSION['username']);
	}
	
	public function logout()
	{
		unset($_SESSION['username']);
		session_destroy();
	}
}
