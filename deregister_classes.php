<html>

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
	3/4/15

	Week 6 of PHP

	1. edit_classes
	2. edit_class

-->

<head>
	<!-- Use the CSS styling from the book, maintain styling -->
	<title>Online Registration</title>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" /> <meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>

<body>

	<div id="container">
		<?php include("includes/header-student.php"); ?>

		<div id="main">

			<div style ="color: red">

				<?php
				//Includes database connection file for authorization
				include("includes/db_connection.php");

							// define a query
				$q = "SELECT * FROM registration INNER JOIN classes ON registration.class_id = classes.class_id WHERE uname = '$uname'";

							// execute the query
				$r = mysqli_query($dbc, $q);
				if (!$r) echo "Sorry, failed connection";


				if(isset($_GET['message'])){
					echo $_GET['message'];
				}
				?>

			</div>

			<div id="class-registration-form" align="center">
				<h1>De-Register Your Classes</h1>
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
						echo '<td><u></u></td>';
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
							echo '<td><a href="deregister_class.php?id='.$row['class_id'].'">Remove</a></td>';
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

		<?php include("includes/footer.html"); ?>
	</div>
</div>

</body>

</html>