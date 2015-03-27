<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/ xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!--

	James Reid Cooper
	SE-611
	2/26/15

	Week 5 of PHP

	1. Cookie
	2. classes.db
	3. Admin
	4. Header/Footer.html
	5. add_classes
	6. Changed color of HTML/CSS

-->

<!--

	James Reid Cooper
	SE-611
	3/27/15

	Week 8 of PHP

	1. view admin logs

-->

<head>
	<title>Online Registration</title>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" /> <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>
	<?php
			// This includes: 1) header banner 2) Session checking for admin
	include("includes/header-admin.php");
	?>

	<div id="content">
		<h1>Welcome, <?php echo $fname ?></h1>
		<?php

		function dropDownMenu($array, $name, $value){
			echo '<select name='.$name.'>';
			foreach ($array as $ar){
				echo '<option value="'.$ar.'"';

				if($ar == $value) echo 'selected = "selected"';

				echo '>'.$ar.'</option>';
			}
			echo '</select>';
		}

		// Limit Number Logs viewed
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($_POST['button'] == "View") {

				$limit = $_POST['limit'];

				//Includes database connection file for authorization
				include("includes/db_connection.php");

				// define a query
				$q = "SELECT * FROM log LIMIT $limit";

				// execute the query
				$r = mysqli_query($dbc, $q);
				if (!$r) echo "Sorry, failed connection";
			}
		} else {

			//Includes database connection file for authorization
			include("includes/db_connection.php");
			// Default to 5 viewed
			$q = "SELECT * FROM log LIMIT 5";

			// execute the query
			$r = mysqli_query($dbc, $q);
			if (!$r) echo "Sorry, failed connection";
		}

		?>
		<div id="system_log" align="center">
			<br>
			<h3>System Log</h3>
			<form action="" method="POST">
				<br>
				<table>
					<tr>
						<td>Number of Logs Viewed:</td>
						<td>
							<?php

							$limit = array(5,10,20,30,50,100);

							dropDownMenu($limit, "limit", $_POST['limit']);
							?>
						</td>
					</tr>
				</table>
				<br>
				<input type="submit" name="button" value="View">
				<br>
				<br>
				<?php
				if (mysqli_num_rows($r)){

					echo '<table id="log_table">';
					echo '<tr>';
					echo '<td id="log_table_row"><u>Time</u></td>';
					echo '<td id="log_table_row"><u>User</u></td>';
					echo '<td id="log_table_row"><u>Action</u></td>';
					echo '</tr>';
					while ($row = mysqli_fetch_array($r)) {
						echo '<tr>';
						echo '<td id="log_table_row">'.($row['time']).'</td>';
						echo '<td id="log_table_row">'.($row['uname']).'</td>';
						echo '<td id="log_table_row">'.($row['action']).'</td>';
						echo '</tr>';
					}
					echo '</table>';
				} else {
					echo '<div style ="color: red">';
					echo 'There are no events logged.';
					echo '</div>';
				}
				?>
			</form>
		</div>
	</div>
	<?php include("includes/footer.html"); ?>
</body>

</html>