<?php
	include_once('includes/message_factory.php');
	include_once('includes/grid_factory.php');
	include_once('includes/security_factory.php');

	$message_factory	= new message_factory();
    $grid_factory 		= new grid_factory();
	$security_factory	= new security_factory();
	
	//Check if we should be here
	$security_factory->check_valid_login();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Super Bowl Box Pool</title>
</head>

<body>

<div style="font-size: 9pt; font-family: 'Arial'">

    <?php

        $grid_factory->display_grid_raw();

    ?>

</div>

</body>
</html>
