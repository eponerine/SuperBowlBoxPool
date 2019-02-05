<?php

	//Check if you belong here...
	include_once('includes/security_factory.php');
	
	$security_factory = new security_factory();
	
	$security_factory->check_valid_login();
	$security_factory->check_admin();
	
	//If we do, make a grid factory and dump the table and reload NULL stuff
	include('includes/grid_factory.php');

	$grid_factory = new grid_factory();

        if ($grid_factory->generate_numbers())
	{
		//Return back to Admin page
		header("Location: http://www.erniecosta.com/superbowl/admin.php?msg=7");
	}
	else
	{
		echo "Failed generating numbers. Something went wrong with the grid_factory module. Eeek.";
	}

?>