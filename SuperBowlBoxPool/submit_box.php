<?php

    //Check if you belong here...
	session_start();

	if ($_SESSION['is_admin'] != null)
	{
            header("Location: http://www.erniecosta.com/superbowl/index.php?error=2");
	}
        
	//Check if data was entered
	if ( !isset($_SESSION['temp_box_id']) || $_POST['name'] == "" || $_POST['email'] == "" )
	{
		//return back with error message
		header("Location: http://www.erniecosta.com/superbowl/edit_box.php?error=3&id=$_SESSION[temp_box_id]");
	}

	include('includes/grid_factory.php');

	//If we do, make a grid factory and put that box in place, ensuring it
    //doesn't already exist or is occupied, etc...

	$grid_factory = new grid_factory();

	//Attempt to update that box's data
	if ( !$grid_factory->insert_box($_SESSION['temp_box_id'], $_POST['name'], $_POST['email']) )
	{
		//If insert fails... return back to edit_box
		header("Location: http://www.erniecosta.com/superbowl/edit_box.php?error=3&id=$_SESSION[temp_box_id]");
	}
	else
	{
		echo '<body onLoad="opener.location.reload();window.close();">';
	}

?>
