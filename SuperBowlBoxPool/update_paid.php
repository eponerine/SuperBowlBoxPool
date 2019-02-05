<?php

	//Check if you belong here...
	session_start();

	if (!$_SESSION['is_admin'])
	{
		header("Location: http://www.erniecosta.com/superbowl/index.php?error=2");
	}

	//If we do, make a grid factory, and update the person's paid status
	include('includes/grid_factory.php');

	$grid_factory = new grid_factory();

    $grid_factory->update_paid_status($_GET['id']);
	
	header("Location: http://www.erniecosta.com/superbowl/admin.php?msg=8");

?>