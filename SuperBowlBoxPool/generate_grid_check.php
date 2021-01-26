<?php

	include_once('includes/security_factory.php');
	include_once('includes/message_factory.php');

	$security_factory = new security_factory();
	$message_factory = new message_factory();

	//Check if we should be here
	$security_factory->check_valid_login();
	$security_factory->check_admin();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="style.css" rel="stylesheet" type="text/css">

<title>Super Bowl Box Pool - Reset Grid Check</title>
</head>

<body>

	<div class="content">

    	<?php include('includes/header.php'); ?>

		<table class="generic">
        	<tr>
            	<td><strong>Are you sure you want to RESET THE GRID?</strong></td>
            </tr>
            <tr>
            	<td><a href="generate_grid.php">☢ YES ☢</a></td>
            </tr>
            <tr>
            	<td><a href="admin.php">No</a></td>
            </tr>
        </table>

    </div>

</body>
</html>
