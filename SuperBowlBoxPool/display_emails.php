<?php

	//Check if you belong here...
	session_start();

	if (!$_SESSION['is_admin'])
	{
		header("Location: http://www.erniecosta.com/superbowl/index.php?error=2");
	}

	//If we do, make a grid factory and dump the table and reload NULL stuff
	include('includes/grid_factory.php');

	$grid_factory = new grid_factory();

        echo $grid_factory->display_emails();

?>