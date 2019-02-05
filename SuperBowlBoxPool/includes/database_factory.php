<?php

	class database_factory
	{
		private $dbhost		= "mysql.hostname.com";
		private $dbuser		= "mysql_username";
		private $dbpassword	= "mysql_password";
		private $dbdatabase = "mysql_database";
		
		private $dbconnection = "";
		
		public function __construct()
		{
			$dbconnection = $this->connect();
			$this->select_db($dbconnection);
		}
		
		private function connect()
		{
			return mysql_connect($this->dbhost, $this->dbuser, $this->dbpassword) or die("Error connecting to MySQL");
		}
		
		private function select_db()
		{
			mysql_select_db($this->dbdatabase) or die("Error selecting database");
		}
		
		public function close()
		{
			mysql_close($this->dbconnection) or die("Cannot close MySQL connection.");
		}
		
		private function sanitize($string)
		{
			return @mysql_real_escape_string(stripslashes($string));
		}
		
		public function query($sql)
		{
			return @mysql_query($sql);
		}
		
		public function get_all_rows($sql)
		{
			$result = @mysql_query($this->sanitize($sql));
			
			return mysql_fetch_array($result);
		}
	}

?>
