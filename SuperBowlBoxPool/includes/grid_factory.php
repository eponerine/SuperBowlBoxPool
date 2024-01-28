<?php

	class grid_factory
	{
		private $database;

		public function __construct()
		{
			//Connect to database, etc
			include_once("includes/database_factory.php");

			$this->database = new database_factory();
		}

		public function insert_box($box_id, $box_name, $box_email)
		{
			if ($box_email != "" && $box_name != "")
			{
				$this->database->query("UPDATE `boxes` SET `name` = '$box_name', `email` = '$box_email' WHERE `id` = $box_id;");
				return true;
			}
			else
			{
				return false;
			}
		}

		public function check_box_taken($box_id)
		{
			echo $box_id;
			$row = mysqli_fetch_array($this->database->query("SELECT * FROM `boxes` WHERE `id` = $box_id AND `name` IS NOT NULL;"));

			if ($row['name'] == NULL)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function display_emails()
		{
			$result = $this->database->query("SELECT DISTINCT `email` FROM `boxes`");

			while ($row = mysqli_fetch_array($result))
			{
				$email_list .= $row['email'] . ", ";
			}

			return $email_list;
		}

		public function print_remaining_boxes()
		{
			$result = $this->database->query("SELECT COUNT(`id`) as `remaining` FROM `boxes` WHERE `name` IS NULL");

			$row = mysqli_fetch_array($result);

			echo $row['remaining'];
		}

		public function update_paid_status($id)
		{
			$this->database->query("UPDATE `boxes` SET `is_paid` = '1' WHERE `id` = $id");
		}

		public function get_num_boxes_sold()
		{
			$result_sold = mysqli_num_rows($this->database->query("SELECT * FROM `boxes` WHERE `name` != '';"));

			return $result_sold;
		}

		public function get_num_boxes_unsold()
		{
			$result_unsold = mysqli_num_rows($this->database->query("SELECT * FROM `boxes` WHERE `name` = '';"));

			return $result_unsold;
		}

		public function get_num_boxes_paid()
		{
			$result_paid = mysqli_num_rows($this->database->query("SELECT * FROM `boxes` WHERE `name` != '' AND `is_paid` = 1;"));

			return $result_paid;
		}

		public function get_num_boxes_unpaid()
		{
			$result_unpaid  = mysqli_num_rows($this->database->query("SELECT * FROM `boxes` WHERE `name` != '' AND `is_paid` = 0;"));

			return $result_unpaid;
		}

		public function display_unpaid()
		{
			$result = $this->database->query("SELECT * FROM `boxes` WHERE `is_paid` = 0 ORDER BY `name`;");

			echo "<table>";

			while ($row = mysqli_fetch_array($result))
			{
				$cash += 20;

				if ($row[1] != "")
				{
					echo "<tr>";
					echo "<td>$row[1]</td> <td>$row[2]</td> <td><a href='update_paid.php?id=$row[0]'>UPDATE</a></td>";
					echo "</tr>";
				}
			}

			echo "</table>";
			echo "--------------------------------------------------<br>";
			echo "<strong>Cash Owed: </strong>$" . $cash . "<br><br>";
			echo "<strong>Boxes Sold: </strong>" . $this->get_num_boxes_sold() . "<br>";
			echo "<strong>Boxes Unsold: </strong>" . $this->get_num_boxes_unsold() . "<br>";
			echo "<strong>Boxes Paid: </strong>" . $this->get_num_boxes_paid() . "<br>";
			echo "<strong>Boxes Unpaid: </strong>" . $this->get_num_boxes_unpaid() . "<br>";
		}

		public function generate_numbers()
		{
			//fill two arrays up with digits 0-9
			$top_numbers = range(0,9);
			$side_numbers = range(0,9);

			//now... shuffle them!
			shuffle($top_numbers);
			shuffle($side_numbers);

			//And lastly... update the database
			$this->database->query("UPDATE `random_numbers` SET `_0` = '$top_numbers[0]', `_1` = '$top_numbers[1]', `_2` = '$top_numbers[2]', `_3` = '$top_numbers[3]', `_4` = '$top_numbers[4]', `_5` = '$top_numbers[5]', `_6` = '$top_numbers[6]', `_7` = '$top_numbers[7]', `_8` = '$top_numbers[8]', `_9` = '$top_numbers[9]'WHERE `name` = 'top';");
			$this->database->query("UPDATE `random_numbers` SET `_0` = '$side_numbers[0]', `_1` = '$side_numbers[1]', `_2` = '$side_numbers[2]', `_3` = '$side_numbers[3]', `_4` = '$side_numbers[4]', `_5` = '$side_numbers[5]', `_6` = '$side_numbers[6]', `_7` = '$side_numbers[7]', `_8` = '$side_numbers[8]', `_9` = '$side_numbers[9]'WHERE `name` = 'side';");

			return true;
		}

		public function reset_grid()
		{
			//Backup the old data first
			$backuptablename = 'boxes_' . date("YmdHis");

			$this->database->query("CREATE TABLE `$backuptablename` LIKE `boxes`");
			$this->database->query("INSERT `$backuptablename` SELECT * FROM `boxes`");

			//Truncate all existing data
			$this->database->query("TRUNCATE TABLE `boxes`");

			//Reload all 100 boxes
			for ($i = 1; $i <= 100; $i++)
			{
				$this->database->query("INSERT INTO `boxes` (`id`, `name`, `email`, `is_paid`) VALUES ('$i', '', '', 0);");
			}

			//Reset numbers to ??? marks
			$this->database->query("UPDATE `random_numbers` SET `_0` = '?', `_1` = '?', `_2` = '?', `_3` = '?', `_4` = '?', `_5` = '?', `_6` = '?', `_7` = '?', `_8` = '?', `_9` = '?' WHERE `name` = 'top';");
			$this->database->query("UPDATE `random_numbers` SET `_0` = '?', `_1` = '?', `_2` = '?', `_3` = '?', `_4` = '?', `_5` = '?', `_6` = '?', `_7` = '?', `_8` = '?', `_9` = '?' WHERE `name` = 'side';");

			//Return completed action
			return true;
		}

        public function reset_grid_randomize()
		{
			//Truncate all existing data
			$this->database->query("TRUNCATE TABLE `boxes`");

			//Reload all 100 boxes
			for ($i = 0; $i <= 100; $i++)
			{
				//make some random shit up and shove it into the DB for testing
				$random_name = "Name " . rand(1, 100);
				$random_email = rand() . "@blahblah.com";

				$this->database->query("INSERT INTO `boxes` (`id`, `name`, `email`, `is_paid`) VALUES ('$i', '$random_name', '$random_email', 0);");
			}

			//Return completed action
			return true;
		}

		public function count_empty_boxes()
		{
			$box_result = $this->database->query("SELECT COUNT(*) as `empty` FROM boxes WHERE `name` is null");

			$row = mysqli_fetch_array($box_result);

			return $row['empty'];
		}

		public function display_grid_raw()
		{
			$box_result = $this->database->query("SELECT * FROM `boxes`;");

			$top_numbers  = mysqli_fetch_array($this->database->query("SELECT * FROM `random_numbers` WHERE `name` = 'top';"));
			$side_numbers = mysqli_fetch_array($this->database->query("SELECT * FROM `random_numbers` WHERE `name` = 'side'"));

			//TOP ROW HEADER
			echo "
			<table width='700' border='1'>
				<tr>
					<td height='50' colspan='12' align='center'>NFC</td>
				</tr>
				<tr>
					<td width='50' align='center' rowspan='11'>AFC</td>
					<td width='50' height='50' align='center'></td>
					<td width='50' height='50' align='center'>$top_numbers[_0]</td>
					<td width='50' height='50' align='center'>$top_numbers[_1]</td>
					<td width='50' height='50' align='center'>$top_numbers[_2]</td>
					<td width='50' height='50' align='center'>$top_numbers[_3]</td>
					<td width='50' height='50' align='center'>$top_numbers[_4]</td>
					<td width='50' height='50' align='center'>$top_numbers[_5]</td>
					<td width='50' height='50' align='center'>$top_numbers[_6]</td>
					<td width='50' height='50' align='center'>$top_numbers[_7]</td>
					<td width='50' height='50' align='center'>$top_numbers[_8]</td>
					<td width='50' height='50' align='center'>$top_numbers[_9]</td>
				</tr>";

			//SIDE NUMBERS AND BOXES
			for($i = 0; $i < 10; $i++)
			{
				//In mySQL, the table's columns have an underscore in front of them. This makes this
				//for loop very sloppy. Should probably clean up mySQL (Ernie 2015)
				$rownumber = "_" . $i;

				echo "
				<tr>
					<td width='50' height='50' align='center'>$side_numbers[$rownumber]</td>";


				for($j = 0; $j < 10; $j++)
				{
					$row = mysqli_fetch_array($box_result);

					//Change highlight color depending if the row is null or not
					if ($row['name'] == null)
					{
						echo "
						<td width='50' height='50' align='center'>" . $row['name'] . "</td>";
					}
					else
					{
						echo "
						<td width='50' height='50' align='center'>" . $row['name'] . "</td>";
					}

				}

				echo "
				</tr>";
			}

			echo "</table>";
		}

		public function display_grid()
		{
			$box_result = $this->database->query("SELECT * FROM `boxes`;");

			$top_numbers  = mysqli_fetch_array($this->database->query("SELECT * FROM `random_numbers` WHERE `name` = 'top';"));
			$side_numbers = mysqli_fetch_array($this->database->query("SELECT * FROM `random_numbers` WHERE `name` = 'side'"));

			//TOP ROW HEADER
			echo '
					<a href="https://paypal.me/eponerine"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_74x46.jpg"</a>

					<a href="https://venmo.com/?txn=pay&recipients=erniecosta%40gmail.com&amount=10&note=Box%20Pool%20x1&audience=private"><img src="https://s3.amazonaws.com/venmo/venmo_logo_blue.png" width="144" /></a>
					<br /><br />' .

			"
			<table class='grid'>
				<tr>
					<td class='grid_boxes_horz' colspan='12'></td>
				</tr>
				<tr>
					<td rowspan='11' class='grid_boxes_vert'></td>
					<td class='grid_boxes_empty'></td>
					<td class='grid_boxes_numbers'>$top_numbers[_0]</td>
					<td class='grid_boxes_numbers'>$top_numbers[_1]</td>
					<td class='grid_boxes_numbers'>$top_numbers[_2]</td>
					<td class='grid_boxes_numbers'>$top_numbers[_3]</td>
					<td class='grid_boxes_numbers'>$top_numbers[_4]</td>
					<td class='grid_boxes_numbers'>$top_numbers[_5]</td>
					<td class='grid_boxes_numbers'>$top_numbers[_6]</td>
					<td class='grid_boxes_numbers'>$top_numbers[_7]</td>
					<td class='grid_boxes_numbers'>$top_numbers[_8]</td>
					<td class='grid_boxes_numbers'>$top_numbers[_9]</td>
				</tr>";

			//SIDE NUMBERS AND BOXES
			for($i = 0; $i < 10; $i++)
			{
				//In mySQL, the table's columns have an underscore in front of them. This makes this
				//for loop very sloppy. Should probably clean up mySQL (Ernie 2015)
				$rownumber = "_" . $i;

				echo "
				<tr>
					<td class='grid_boxes_numbers'>" . $side_numbers[$rownumber] . "</td>";


				for($j = 0; $j < 10; $j++)
				{
					$row = mysqli_fetch_array($box_result);

					//Change highlight color depending if the row is null or not
					if ($row['name'] == null)
					{
						echo "
						<td class='grid_boxes' onclick=\"window.open('edit_box.php?id=$row[id]', 'edit_box', 'width=525, height=400')\">" . $row['name'] . "</td>";
					}
					else
					{

						echo "
						<td class='grid_boxes_occupied'>";

						if ($row['is_paid'])
						{
							echo '<img src="images/paid.png"><br />';
						}

						echo $row['name'] . "</td>";
					}

				}

				echo "
				</tr>";
			}

			echo "</table>";
		}

		public function display_grid_div()
		{
			$box_result = $this->database->query("SELECT * FROM `boxes`;");

			$top_numbers  = mysqli_fetch_array($this->database->query("SELECT * FROM `random_numbers` WHERE `name` = 'top';"));
			$side_numbers = mysqli_fetch_array($this->database->query("SELECT * FROM `random_numbers` WHERE `name` = 'side'"));

			//TOP ROW HEADER
			echo
			"<div class='section group'>
					<div class='col span_1_of_11_header'><span class='AFC'>AFC &darr; </span> <span class='NFC'>NFC &rarr;</span></div>
					<div class='col span_1_of_11_header'>$top_numbers[_0]</div>
					<div class='col span_1_of_11_header'>$top_numbers[_1]</div>
					<div class='col span_1_of_11_header'>$top_numbers[_2]</div>
					<div class='col span_1_of_11_header'>$top_numbers[_3]</div>
					<div class='col span_1_of_11_header'>$top_numbers[_4]</div>
					<div class='col span_1_of_11_header'>$top_numbers[_5]</div>
					<div class='col span_1_of_11_header'>$top_numbers[_6]</div>
					<div class='col span_1_of_11_header'>$top_numbers[_7]</div>
					<div class='col span_1_of_11_header'>$top_numbers[_8]</div>
					<div class='col span_1_of_11_header'>$top_numbers[_9]</div>
			</div>";


			//SIDE NUMBERS AND BOXES
			for($i = 0; $i < 10; $i++)
			{
				//In mySQL, the table's columns have an underscore in front of them. This makes this
				//for loop very sloppy. Should probably clean up mySQL (Ernie 2015)
				$rownumber = "_" . $i;

				echo
					"<div class='section group'><div class='col span_1_of_11_header'>$side_numbers[$rownumber]</div>";

				for($j = 0; $j < 10; $j++)
				{
					$row = mysqli_fetch_array($box_result);

					//Change highlight color depending if the row is null or not
					if ($row['name'] == null)
					{
						// Generate clickable div
						echo "<div style='cursor: copy;' class='col span_1_of_11' onclick=\"window.open('edit_box.php?id=$row[id]', 'edit_box', 'width=525, height=400')\">" . $row['name'] . "</div>";
					}
					else
					{
						if ($row['is_paid'])
						{
							echo '<div class="col span_1_of_11"><span class="paid">' . $row['name'] . '</span></div>';
						}
						else
						{
							echo '<div class="col span_1_of_11">' . $row['name'] . '</div>';
						}
					}
				}

				echo "</div>";
			}
		}
	}
?>
