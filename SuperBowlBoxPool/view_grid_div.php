<?php

	include_once('includes/security_factory.php');
	include_once('includes/message_factory.php');
	include_once('includes/grid_factory_div.php');
	
	$security_factory	= new security_factory();
	$message_factory	= new message_factory();
    $grid_factory		= new grid_factory_div();
	
	//Check if we should be here
	$security_factory->check_valid_login();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css">

<script src='http://platform.venmo.com/sdk.js'></script>


<title>Super Bowl Box Pool</title>
</head>

<body>

<div class="content_div">
    
	<div class="section group">
		<?php 
			include_once('includes/header.php');
			
			$grid_factory->display_grid_div();
		?>
	</div>
	
	<br />
	
    <a href="print.php">Printable Version</a> - <a href="faq.php">FAQ</a> - <a href="mailto:erniecosta@gmail.com">Contact</a>
    
</div>

</body>
</html>
