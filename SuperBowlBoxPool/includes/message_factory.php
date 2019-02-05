<?php

	class message_factory
	{
		public function display_error($e)
		{
			//Error strings
			switch($e)
			{
				case 1:
					$msg = "You have supplied invalid login credentials. Please check your username and password and try again.";
					break;
				case 2:
					$msg = "You attempted to access a page you don't have permission to view.";
					break;
				case 3:
					$msg = "You forgot some info... try again!";
					break;
				case 4:
					$msg = "Something went wrong with the box ID. Try again!";
					break;
				case 5:
					$msg = "You're attempting to select a box that is already taken. Try again.";
					break;
					
				default:
					$msg = "Unknown error has occured - $e";
			}
			
			//Output HTML
			echo '
			
			<table class="error">
        	<tr>
            	<td>' . $msg . '</td>
            </tr>
        </table><br>';
			
		}
		
		public function display_message($e)
		{
			//Message strings
			switch($e)
			{
				case 1:
					$msg = "Grid truncation and recreation complete.";
					break;
				case 2:
					$msg = "Logged out successfully.";
					break;
                case 3:
					$msg = "Fill out your info below. Please keep your name to 11 characters or less:";
					break;
                case 4:
					$msg = "Pick a box out from below that isn't already taken. Don't take more than you intend on paying for! Numbers will be randomized before kickoff. See below for more info.";
					break;
                case 5:
					include_once('grid_factory.php');
					$temp_grid_factory = new grid_factory();
					$boxes_left = $temp_grid_factory->count_empty_boxes();
					$msg = "<strong>Hurry! Only $boxes_left boxes are left!!! Don't miss out!</strong>";
					break;
				case 6:
					$msg = "All boxes have been filled. Numbers will be drawn before kickoff (or when all cash is received). Thank you very much and good luck!";
					break;

				case 7:
					$msg = "Numbers generated.";
					break;
					
				case 8:
					$msg = "Paid Status Updated!";
					break;

				default:
					$msg = "Unknown message has occured - $e";
			}
			
			//Output HTML
			echo '
			
			<table class="message">
        	<tr>
            	<td>' . $msg . '</td>
            </tr>
        </table><br>';
			
		}
	}

?>