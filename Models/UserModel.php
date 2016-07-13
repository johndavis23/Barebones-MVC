<?php
	include_once("Config/config.php");
	include_once("Classes/Model.php");
	
	#################################
	// Model
	#################################
	class UserModel extends Model
	{
		function __construct()
		{
			
			if (session_status() === PHP_SESSION_NONE)
			{
				session_start();
			}
			parent::__construct('Users', 'ID');
		}
		
		private function constructDatabaseTableQuery()
		{
			return "CREATE TABLE Users
					(
					ID int NOT NULL AUTO_INCREMENT,
					username varchar(255) NOT NULL,
					password varchar(255),
					email varchar(255),
					PRIMARY KEY (ID)
					)";
		}
		
		public function registerUser(  $username,  $password, $email)
		{
			if($this->create([	"username"	=>	$username, 
								"password"	=> 	self::saltPassword($username,$password), 
								"email"     =>$email ]))
			{
				$_SESSION['notify'][] = "User registered.";
			}
			else
			{
				$_SESSION['error'][]  = "User registeration failed.";
			}
		}	
		
		public function userExistsWithPlainPassword( $username,  $plain_text_password)
		{
			return $this->exists([		"username"	=>	$username, 
									 	"password"	=> 	self::saltPassword($username, $plain_text_password)]);
		}
		
		
		static function saltPassword($username, $password)
		{
			return md5( $login.':'.$password ); //salt and encrypt passwords
		}
		
	}