<?php

	$u = $_POST['username'];
	$p = hash("sha256",($_POST['password']));

	include("includes/database_factory.php");

	$database = new database_factory();

	//OK... check if login is valid
	$result = $database->query("SELECT * FROM `users` WHERE `username` = '$u' AND `password` = '$p';");

	if (!$result)
	{
		echo "Error... could not run query: " . mysql_error();
		exit;
	}

	//Empty return set
	if (mysqli_num_rows($result) == 0)
	{
		header("Location: http://www.erniecosta.com/superbowl/index.php?error=1");
	}
	else	//Username and PW combo exist... check if admin or not, redirect
	{
		$row = mysqli_fetch_assoc($result);

		if ($row['is_admin'] == 1)
		{
			session_start();
			$_SESSION['is_admin'] = true;
			$_SESSION['is_valid_login'] = true;
			header("Location: http://www.erniecosta.com/superbowl/admin.php");
		}
		else if ($row['is_admin'] == 0)
		{
			session_start();
			$_SESSION['is_admin'] = false;
			$_SESSION['is_valid_login'] = true;
			header("Location: http://www.erniecosta.com/superbowl/view_grid.php");
		}

	}
?>
