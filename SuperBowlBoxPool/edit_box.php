<?php

	include_once('includes/security_factory.php');
	include_once('includes/message_factory.php');
	include_once('includes/grid_factory.php');
	
	$security_factory	= new security_factory();
	$message_factory = new message_factory();
	$grid_factory = new grid_factory();
	
	//Check if we should be here
	$security_factory->check_valid_login();
	
	//Make sure an ID was passed
	if (!isset($_GET['id']))
	{
		header("Location: http://www.erniecosta.com/superbowl/view_grid.php?error=4");
	}

	//Make sure that box ID isn't already taken by someone trying to hack their way in (Erik 2013)
	if ($grid_factory->check_box_taken($_GET['id']) == false)
	{
		header("Location: http://www.erniecosta.com/superbowl/view_grid.php?error=5");
	}

	//After all these checks, we can now put that ID in the SESSION variable!
	$_SESSION['temp_box_id'] = $_GET['id'];	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="style.css" rel="stylesheet" type="text/css">

<title>Pick Your Box!</title>
</head>

<body>


    <?php 
        
        if (isset($_GET['error']))
        {
            $message_factory->display_error($_GET['error']);
        }
        
        $message_factory->display_message(3);
    ?>
    
    <form action="submit_box.php" method="post">
    <table width="500" class="info">
        <tr>
            <td width="40%" align="right">Name: </td>
            <td width="60%" align="left"><input name="name" size="20" maxlength="11" /></td>
        </tr>
        <tr>
            <td align="right">Email: </td>
            <td align="left"><input name="email" size="20" /></td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <button type="submit" name="submit" value="Submit">Submit</button>
            </td>
        </tr>
    </table>
    </form>

</body>
</html>
