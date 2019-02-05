<?php

	class security_factory
	{
		
		public function __construct()
		{
			//Connect to database, etc
			session_start();
		}
		
		public function check_valid_login()
		{
			if ($_SESSION['is_valid_login'] == true)
			{
				return true;
			}
			else
			{
				header("Location: http://www.erniecosta.com/superbowl/index.php?error=2");
			}
		}
		
		public function check_admin()
		{
			if ($_SESSION['is_admin'] == true)
			{
				return true;
			}
			else
			{
				header("Location: http://www.erniecosta.com/superbowl/index.php?error=2");
			}
		}
		
	}
	
?>