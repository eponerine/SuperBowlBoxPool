
	<div class="logout">
    	<a href="logout.php">Logout</a>
    </div>

    	<table class="header">
        	<tr>
            	<td class="logo">
                	<img class="logo" src="images/logo.png" height="40%" />
                </td>
            </tr>
        </table>

        <?php

			if (isset($_GET['error']))
			{
				$message_factory->display_error($_GET['error']);
			}
			if (isset($_GET['msg']))
			{
				$message_factory->display_message($_GET['msg']);
			}

		?>
