<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/ xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!--

	Week 4 of PHP

	1. edit_profile.php
	2. Header/Footer
	3. student.php
	4. index4.php

-->

<!--

	Week 5 of PHP

	1. Cookie
	2. classes.db
	3. Admin

-->

<head>
	<title>Online Registration</title>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" /> <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>
	<?php
	include("includes/header-student.php");
	?>
	<div id="content">
		<h1>Welcome, <?php echo $fname." (".$uname.")" ?></h1>
		<?php
		//Includes database connection file for authorization
		include("includes/db_connection.php");

							// define a query
		$q = "SELECT * FROM registration INNER JOIN classes ON registration.class_id = classes.class_id WHERE uname = '$uname'";

							// execute the query
		$r = mysqli_query($dbc, $q);
		if (!$r) echo "Sorry, failed connection";

		?>
		<div id="class-registration-form" align="center">
			<br>
			<h3>Schedule</h3>
			<form action="" method="POST">
				<br>
				<?php
				if (mysqli_num_rows($r)){

					echo '<table>';
					echo '<tr>';
					echo '<td><u>Subject</u></td>';
					echo '<td><u>Code</u></td>';
					echo '<td><u>Section</u></td>';
					echo '<td><u>Name</u></td>';
					echo '<td><u>Schedule</u></td>';
					echo '<td><u>Professor</u></td>';
					echo '<td><u>Room</u></td>';
					echo '</tr>';
					while ($row = mysqli_fetch_array($r)) {
						echo '<tr>';
						echo '<td>'.($row['subject']).'</td>';
						echo '<td>'.($row['code']).'</td>';
						echo '<td>'.($row['section']).'</td>';
						echo '<td>'.($row['name']).'</td>';
						echo '<td>'.($row['schedule']).'</td>';
						echo '<td>'.($row['professor']).'</td>';
						echo '<td>'.($row['room']).'</td>';
						echo '</tr>';
					}
					echo '</table>';
				} else {
					echo '<div style ="color: red">';
					echo 'There are no classes registered.';
					echo '</div>';
				}
				?>
			</form>
		</div>
	</div>
	<div id="footer">
		<p>Copyright 2015 Monmouth University</p>
	</div>
</body>

</html>