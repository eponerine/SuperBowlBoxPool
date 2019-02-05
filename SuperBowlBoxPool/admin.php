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

<title>Super Bowl Box Pool - Administrator Settings</title>
</head>

<body>

	<div class="content">
    
    	<?php include('includes/header.php'); ?>
        
		<table class="generic">
        	<tr>
            	<td><strong>Administrator Tools:</strong></td>
            </tr>
            <tr>
            	<td><a href="generate_grid.php">Table Reset/Reload</a></td>
            </tr>
            <tr>
            	<td><a href="generate_numbers.php">Generate Numbers</a></td>
            </tr>
            <tr>
            	<td><a href="display_emails.php">Display Emails</a></td>
            </tr>
            <tr>
            	<td><a href="display_unpaid.php">Update/Display Unpaid Status</a></td>
            </tr>
        </table>
    
    </div>

</body>
</html>
