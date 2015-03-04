<html>

<!--
	
	James Reid Cooper
	SE-611
	2/26/15
	Assignment 3

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
	<title>SE611</title>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" /> <meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>

<body>

	<div id="container">
		<?php include("includes/header-admin.html"); ?>
		
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

				// Maintain the session that is being used by a particular USER
				session_start();

				// If there is no cookie with a username, redirect to Index
				// Else set the cookies to the username and first name for personal greeting (possibly)
				if(empty($_COOKIE['uname'])){
					header('LOCATION: index4.php');
				} else {
					$uname = $_COOKIE['uname'];
					$fname = $_COOKIE['fname'];
				}

				// If the user role is not set as 1 (ADMIN) then redirect page back to index
				if ($_SESSION['role'] == 0){
					header('LOCATION: index4.php');
				}

				// when the form in this page is submitted
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if($_POST['button'] == "Update") {

						$subject = $_POST['subject'];
						$code = $_POST['code'];
						$section = $_POST['section'];
						$name = $_POST['name'];
						$schedule = $_POST['schedule'];
						$professor = $_POST['professor'];
						$room = $_POST['room'];
						$class_id = $_POST['class_id'];

						// Define an array of error
						$error = array();

						if (empty($subject)){
							$error[] = "You forgot to enter subject.";
						}
						if (empty($code)){
							$error[] = "You forgot to enter code.";
						}
						if (empty($section)){
							$error[] = "You forgot to enter section.";
						}
						if (empty($name)){
							$error[] = "You forgot to enter name.";
						}
						if (empty($schedule)){
							$error[] = "You forgot to enter schedule.";
						}
						if (empty($professor)){
							$error[] = "You forgot to enter professor.";
						}
						if (empty($room)){
							$error[] = "You forgot to enter room.";
						}

						// Check to see if anything in $error.
						if (empty($error)){

							// DB Connection
							$dbc = mysqli_connect('localhost', 'root', 'password', 'registration') or die ('Not Connected');
							
							// define a query
							$q = "UPDATE classes SET subject= '$subject', code='$code', section='$section', name='$name', schedule='$schedule', professor='$professor', room='$room' WHERE class_id = '$class_id'";

							// execute the query
							$r = mysqli_query($dbc, $q);
							if ($r) echo "Update Class";
							else echo "Sorry, failed connection";

						} else {
							foreach ($error as $msg) {
								echo $msg;
								echo '<br>';
							}
						}
					}
				} else {
					if(isset($_GET['id'])){

						$class_id = $_GET['id'];

						$dbc = mysqli_connect('localhost', 'root', 'password', 'registration') or die ("Cannot connect to database.");

						$q = "SELECT * FROM classes WHERE class_id='$class_id'";

						$r = mysqli_query($dbc, $q);

						if (mysqli_num_rows($r) == 1){
							$row = mysqli_fetch_array($r);
							$subject = $row['subject'];
							$code = $row['code'];
							$section = $row['section'];
							$name = $row['name'];
							$schedule = $row['schedule'];
							$professor = $row['professor'];
							$room = $row['room'];
						}else {
							echo "Could Not Retrieve Class Information";
						}
					}
				}
				?>

			</div>
			<div id="class-registration-form" align="left">
				<h1>Update Class</h1>
				<form action="" method="POST">
					<table>
						<tr>
							<td>Subject:</td>
							<td> 
								<?php

								$subjectsArray = array("CS", "SE", "MA", "EN", "EDU", "DA");

								dropDownMenu($subjectsArray, "subject", $subject);
								?>
							</td>
						</tr>
						<tr>
							<td>Code:</td>
							<td><input type="text" name="code" value="<?php if(isset($_POST['code'])){ echo $_POST['code'];} else { echo $code;}?>"></td>
						</tr>
						<tr>
							<td>Section:</td>
							<td><input type="text" name="section" value="<?php if(isset($_POST['section'])){ echo $_POST['section'];} else { echo $section;}?>"></td>
						</tr>
						<tr>
							<td>Name:</td>
							<td><input type="text" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];} else { echo $name;} ?>"></td>
						</tr>
						<tr>
							<td>Schedule:</td>
							<td><input type="text" name="schedule" value="<?php if(isset($_POST['schedule'])){ echo $_POST['schedule'];} else { echo $schedule;}?>"></td>
						</tr>
						<tr>
							<td>Professor:</td>
							<td><input type="text" name="professor" value="<?php if(isset($_POST['professor'])){ echo $_POST['professor'];} else { echo $professor;} ?>"></td>
						</tr>
						<tr>
							<td>Room:</td>
							<td><input type="text" name="room" value="<?php if(isset($_POST['room'])){ echo $_POST['room'];} else { echo $room;} ?>"></td>
						</tr>
					</table>
					<br>
					<input type="submit" name="button" value="Update">
					<input type="hidden" name="class_id" value="<?php echo $class_id;?>"/>
				</form>

				<div id="class-update-output" align="center" style ="color: red">

					<br>
					<?php
					// For personal flair, output the class that was entered
					// As long as there is no error, output
					// For the life of me, I forgot why I check to make sure Subject is filled out, no sure why
					// Correction! Its so it doesnt show up when the page loads, the "added" class
					if (empty($error)){
						if(isset($_POST['name'])){
							echo "Updated: " . $subject ."-". $code ."-". $section ." ". $name ." ". $schedule ." ". $professor ." ". $room;
						}
					}
					?>
					<br>
					<br>
				</div>

			</div>
		</div>

		<?php include("includes/footer.html"); ?> 
	</div>
</div>

</body>

</html>