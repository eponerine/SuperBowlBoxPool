<?php

	class database_factory
	{
		private $dbhost		= "mysql.hostname.com";
		private $dbuser		= "mysql_username";
		private $dbpassword	= "mysql_password";
		private $dbdatabase = "mysql_database";
		
		private $dbconnection;
		
		public function __construct()
		{
			$this->dbconnection = $this->connect();
		}
		
		private function connect()
		{
			$link = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbdatabase);

			if (!$link) {
				echo "Error: Unable to connect to MySQL.";
			}

			return $link;
		}
		
		private function select_db()
		{
			mysqli_select_db($this->dbdatabase) or die("Error selecting database!");
		}
		
		public function close()
		{
			mysqli_close($this->dbconnection) or die("Cannot close MySQL connection.");
		}
		
		private function sanitize($string)
		{
			return mysqli_real_escape_string($this->dbconnection,stripslashes($string));
		}
		
		public function query($sql)
		{
			return mysqli_query($this->dbconnection,$sql);
		}
		
		public function get_all_rows($sql)
		{
			$result = mysqli_query($this->dbconnection,$this->sanitize($sql));
			
			return mysqli_fetch_array($result);
		}
	}

?>
