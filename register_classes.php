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
<!--

	James Reid Cooper
	SE-611
	3/11/15

	Week 7 of PHP

	1. register_classes
	2. register_class
	3. db_connection
	4. deregister_class

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
				function dropDownMenu($array, $name, $value){
					echo '<select name='.$name.'>';
					foreach ($array as $ar){
						echo '<option value="'.$ar.'"';

						if($ar == $value) echo 'selected = "selected"';

						echo '>'.$ar.'</option>';
					}
					echo '</select>';
				}
				?>

				<?php

				// when the form in this page is submitted
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if($_POST['button'] == "Display Classes") {

						$subject = $_POST['subjects'];

						//Includes database connection file for authorization
						include("includes/db_connection.php");

							// define a query
						$q = "SELECT * FROM classes WHERE subject = '$subject'";

							// execute the query
						$r = mysqli_query($dbc, $q);
						if (!$r) echo "Sorry, failed connection";
					}
				}
				if(isset($_GET['message'])){
					echo $_GET['message'];
				}
				?>

			</div>

			<div id="class-registration-form" align="center">
				<h1>Register Classes</h1>
				<form action="" method="POST">
					<br>
					<table>
						<tr>
							<td>Subject:</td>
							<td>
								<?php

								$subjects = array("CS", "SE", "MA", "EN", "EDU", "DA");

								dropDownMenu($subjects, "subjects", $_POST['subjects']);
								?>
							</td>
						</tr>
					</table>
					<br>
					<input type="submit" name="button" value="Display Classes">
					<br>
					<br>
					<?php
					if (isset($r)){
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
								echo '<td><a href="register_class.php?id='.$row['class_id'].'">Register</a></td>';
								echo '</tr>';
							}
							echo '</table>';
						} else {
							echo '<div style ="color: red">';
							echo 'There are no classes displayed for this subject.';
							echo '</div>';
						}
					} else {
						echo '<div style ="color: red">';
						echo 'There are no classes displayed for this subject.';
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