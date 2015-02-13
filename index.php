<html>

<head>

	<title>SE611</title>
	<style>

		body {
			background-color: grey
		}
		#container {
			width: 800px;
		}

		#header {
			background-color: blue;
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
			background-color: blue;
			height: 30px;
			text-align: center;
			color: white;
		}

	</style>

</head>

<body>

	<div id="container">
		<div id="header">
			<h1>Online Registration System</h1>
		</div>

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

		<div id="main">

			<div style ="color: red">

				<?php

				// Login Attempts
				$count = 0;

				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if($_POST['button'] == "Login") {

						$uname = $_POST['uname'];
						$psword = $_POST['psword'];
						$count = $_POST['count'] + 1;
					// $state = $_POST['states'];
					// $major = $_POST['majors'];
					// $sex = $_POST['sex'];


					// Define an array of error
						$error = array();

						if (empty($uname)){
							$error[] = "You forgot to enter username.";

						}

						if (empty($psword)){
							$error[] = "You forgot to enter password.";
						}

						// Check to see if anything in $error.
						if (empty($error)){
						//everything is good
							$_POST['count'] = 0;
							$count = 0;
						} else {
							foreach ($error as $msg) {
								echo $msg;
							}

							echo $count;

						}
					}

					if($_POST['button'] == "Register"){

						$occupation = $_POST['occupation'];
						echo 'Registration';
						if(empty($occupation)){
							echo '<br>';
							echo 'Please Enter Occupation';
						} else {
							echo '<br>';
							echo $occupation;
						}
						
					}
				}
				?>

			</div>

			<form action="" method="POST">
				<table style="padding: 50px 290px">
					<tr>
						<td>Username:</td>
						<td><input type="text" name="uname" value= <?php if(isset($_POST['uname'])) echo $_POST['uname']; ?> ></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="psword" /></td>
					</tr>
					<tr>
						<td><input type="radio" name="sex" value="male"> Male</td>
						<br>
						<td><input type="radio" name="sex" value="female"> Female</td>
					</tr>
					<tr>
						<td>
							<?php

							$states = array("Alabama","Alaska","Arizona","Arkansas","California","Colorado",
								"Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho",
								"Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine",	
								"Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri",
								"Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico",
								"New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon",	
								"Pennsylvania","Rhode Island","South Carolina","South Dakota",
								"Tennessee","Texas","Utah","Vermont","Virginia","Washington",
								"Washington DC","West Virginia","Wisconsin","Wyoming");

							dropDownMenu($states, "states", $_POST['states']);

							?>

						</td>
					</tr>
					<tr>
						<td>
							<?php

							$majors = array("CS", "SE", "ART", "EN", "CHEM", "BIO", "COMM", "PHY", "EDU", "MATH");

							dropDownMenu($majors, "majors", $_POST['majors']);
							?>
						</td>
					</tr>
					<tr>
						<!-- Login Attempts !--> 
						<td><input type="hidden" name="count" value=<?php echo $count ?>></td>
					</tr>
					<tr>
						<td><input type="submit" name="button" value="Login"></td>
					</tr>
				</table>
			</form>
			<form action="" method="POST">
				<table style="padding: 0px 290px">
					<tr>
						<td><input type="radio" name="occupation" value="student"> Student</td>
						<br>
						<td><input type="radio" name="occupation" value="professor"> Professor</td>
					</tr>
					<tr>
						<td><input type="submit" name="button" value="Register"></td>
					</tr>
				</table>
			</form>
		</div>

		<div id="footer">
			<p>Copyright 2015 Monmouth University</p>
		</div>
	</div>

</body>

</html>