<?php

	session_start();
	session_destroy();
	
	header("Location: http://www.erniecosta.com/superbowl/index.php?msg=2");
		
?>