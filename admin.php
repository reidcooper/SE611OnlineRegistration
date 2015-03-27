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
		//Includes database connection file for authorization
		include("includes/db_connection.php");

							// define a query
		$q = "SELECT * FROM classes";

							// execute the query
		$r = mysqli_query($dbc, $q);
		if (!$r) echo "Sorry, failed connection";

		?>
		<div id="class-registration-form" align="center">
			<br>
			<h3>Available Classes</h3>
			<form action="" method="POST">
				<br>
				<?php
				if (mysqli_num_rows($r)){

					echo '<table>';
					echo '<tr>';
					echo '<td id="edit_classes_table_row"><u>Subject</u></td>';
					echo '<td id="edit_classes_table_row"><u>Code</u></td>';
					echo '<td id="edit_classes_table_row"><u>Section</u></td>';
					echo '<td id="edit_classes_table_row"><u>Name</u></td>';
					echo '<td id="edit_classes_table_row"><u>Schedule</u></td>';
					echo '<td id="edit_classes_table_row"><u>Professor</u></td>';
					echo '<td id="edit_classes_table_row"><u>Room</u></td>';
					echo '</tr>';
					while ($row = mysqli_fetch_array($r)) {
						echo '<tr>';
						echo '<td id="edit_classes_table_row">'.($row['subject']).'</td>';
						echo '<td id="edit_classes_table_row">'.($row['code']).'</td>';
						echo '<td id="edit_classes_table_row">'.($row['section']).'</td>';
						echo '<td id="edit_classes_table_row">'.($row['name']).'</td>';
						echo '<td id="edit_classes_table_row">'.($row['schedule']).'</td>';
						echo '<td id="edit_classes_table_row">'.($row['professor']).'</td>';
						echo '<td id="edit_classes_table_row">'.($row['room']).'</td>';
						echo '</tr>';
					}
					echo '</table>';
				} else {
					echo '<div style ="color: red">';
					echo 'There are no classes available.';
					echo '</div>';
				}
				?>
			</form>
		</div>
	</div>
	<?php include("includes/footer.html"); ?>
</body>

</html>