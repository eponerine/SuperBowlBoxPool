<?php

	include('includes/message_factory.php');
	
	$message_factory = new message_factory();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="style.css" rel="stylesheet" type="text/css">

<title>Super Bowl Box Pool</title>
</head>

<body>

    <div class="credits">
    	Created by Ernie Costa
    </div>

    <div class="content">
    
    <?php include('includes/header.php'); ?>
        
        
        <form id="login" name="login" action="login.php" method="post">
		<table class="login">
        	<tr>
            	<td colspan="2">Please enter pool credentials:</td>
            </tr>
            <tr>
            	<td class="login_label">User Type: </td>
            	<td class="login_data">
                	<select name="username" id="username">
                		<option value="User">User</option>
                		<option value="Admin">Admin</option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td class="login_label">Password: </td>
                <td class="login_data"><input type="password" name="password" id="password" /></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Submit</button></td>
            </tr>
        </table>
        </form>
    
    </div>

</body>
</html>
