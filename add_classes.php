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

<head>

	<title>SE611</title>
	<style>

		body {
			background-color: grey
		}
		#container {
			width: 800px;
			margin: 0 auto;
		}

		#header {
			background-color: rgb(0,46,106);
			height: 60px;
			text-align: center;
			color: white;
			padding: 2px;
		}

		#main {
			background-color: white;
			height: 400px;
		}

		#footer {
			background-color: rgb(0,46,106);
			height: 50px;
			text-align: center;
			color: white;
			padding: 2px;
		}

	</style>

</head>

<body>

	<div id="container">
		<div id="header">
			<h1>Online Registration System</h1>
		</div>
		
		<div id="main">

			<div style ="color: red">

				<?php

				// Maintain the session that is being used by a particular USER
				session_start();

				if(empty($_COOKIE['uname'])){
					header('LOCATION: index4.php');
				} else {
					$uname = $_COOKIE['uname'];
					$fname = $_COOKIE['fname'];
				}

				if ($_SESSION['role'] == 0){
					header('LOCATION: index4.php');
				}

				// when the form in this page is submitted
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if($_POST['button'] == "Add Class") {

						$subject = $_POST['subject'];
						$code = $_POST['code'];
						$section = $_POST['section'];
						$name = $_POST['name'];
						$schedule = $_POST['schedule'];
						$professor = $_POST['professor'];
						$room = $_POST['room'];

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
							$q = "INSERT INTO classes (subject, code, section, name, schedule, professor, room) VALUES ('$subject', '$code', '$section', '$name', '$schedule', '$professor', '$room')";

							// execute the query
							$r = mysqli_query($dbc, $q);
							if ($r) echo "The class is inserted to the DB.";
							else echo "Sorry, failed connection";

						} else {
							foreach ($error as $msg) {
								echo $msg;
								echo '<br>';
							}
						}
					}
				}
				?>

			</div>

			<div id="class-registration-form">
				<form action="" method="POST">
					<table align="center">
						<tr>
							<td>Subject:</td>
							<td><input type="text" name="subject" value="<?php if(isset($_POST['subject'])) echo $_POST['subject']; ?>"></td>
						</tr>
						<tr>
							<td>Code:</td>
							<td><input type="text" name="code" value="<?php if(isset($_POST['code'])) echo $_POST['code']; ?>"></td>
						</tr>
						<tr>
							<td>Section:</td>
							<td><input type="text" name="section" value="<?php if(isset($_POST['section'])) echo $_POST['section']; ?>"></td>
						</tr>
						<tr>
							<td>Name:</td>
							<td><input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>"></td>
						</tr>
						<tr>
							<td>Schedule:</td>
							<td><input type="text" name="schedule" value="<?php if(isset($_POST['schedule'])) echo $_POST['schedule']; ?>"></td>
						</tr>
						<tr>
							<td>Professor:</td>
							<td><input type="text" name="professor" value="<?php if(isset($_POST['professor'])) echo $_POST['professor']; ?>"></td>
						</tr>
						<tr>
							<td>Room:</td>
							<td><input type="text" name="room" value="<?php if(isset($_POST['room'])) echo $_POST['room']; ?>"></td>
						</tr>
						<tr>
							<td><input type="submit" name="button" value="Add Class"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>

		<?php include("includes/footer.html"); ?> 
	</div>
</div>

</body>

</html>