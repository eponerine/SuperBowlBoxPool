<?php

	//Check if you belong here...
	include_once('includes/security_factory.php');
	
	$security_factory = new security_factory();
	
	$security_factory->check_valid_login();
	$security_factory->check_admin();

	//If we do, make a grid factory and dump the table and reload NULL stuff
	include('includes/grid_factory.php');

	$grid_factory = new grid_factory();

    echo $grid_factory->display_unpaid();

?>