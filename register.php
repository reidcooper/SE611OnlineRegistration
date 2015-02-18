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

				// when we get here form other pages
				if (isset($_GET['role'])){
					$role = $_GET['role'];
					echo $role;
					echo '<br>';
				}

				// when the form in this page is submitted
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if($_POST['button'] == "Register") {

						$uname = $_POST['uname'];
						$psword = $_POST['psword'];
						$confirm_password = $_POST['confirm_password'];
						$fname = $_POST['fname'];
						$lname = $_POST['lname'];
						$major = $_POST['majors'];
						$address = $_POST['address'];
						$city = $_POST['city'];
						$state = $_POST['state'];
						$email = $_POST['email'];
						$phone = $_POST['phone'];
						$role = $_POST['role'];

						if ($role == 'Admin'){
							$role = 1;
						}

						if ($role == 'Student'){
							$role = 0;
						} 


						// Define an array of error
						$error = array();

						if (empty($uname)){
							$error[] = "You forgot to enter username.";
						}
						if (empty($psword)){
							$error[] = "You forgot to enter password.";
						}
						if (empty($confirm_password)){
							$error[] = "You forgot to confirm your password.";
						}
						if (empty($fname)){
							$error[] = "You forgot to enter a first name.";
						}
						if (empty($lname)){
							$error[] = "You forgot to enter a last name.";
						}
						if (empty($major)){
							$error[] = "You forgot to enter a major.";
						}
						if (empty($address)){
							$error[] = "You forgot to enter a address.";
						}
						if (empty($city)){
							$error[] = "You forgot to enter a city.";
						}
						if (empty($state)){
							$error[] = "You forgot to enter a state.";
						}
						if (empty($email)){
							$error[] = "You forgot to enter a email.";
						}
						if (empty($phone)){
							$error[] = "You forgot to enter a phone.";
						}
						if ($psword != $confirm_password){
							$error[] = "Your passwords do not match.";
						}

						if( strlen($psword) < 8) {
							$error[] = "Password too short!";
						}

						if( !preg_match("#[0-9]+#", $psword) ) {
							$error[] = "Password must include at least one number! ";
						}

						// Check to see if anything in $error.
						if (empty($error)){

							// DB Connection
							$dbc = mysqli_connect('localhost', 'root', 'password', 'registration') or die ('Not Connected');
							
							// define a query
							$q = "INSERT INTO users (uname, psword, fname, lname, major, address, city, state, email, phone, role, reg_date) VALUES ('$uname', SHA1('$psword'), '$fname', '$lname', '$major', '$address', '$city', '$state', '$email', '$phone', '$role', now())";

							// execute the query
							$r = mysqli_query($dbc, $q);
							if ($r) echo "The record is inserted to the DB.";
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

			<div id="registration-form">
				<form action="" method="POST">
					<table align="center">
						<tr>
							<td>Username:</td>
							<td><input type="text" name="uname" value=" <?php if(isset($_POST['uname'])) echo $_POST['uname']; ?> "></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type="password" name="psword" /></td>
						</tr>
						<tr>
							<td>Confirm Password:</td>
							<td><input type="password" name="confirm_password" /></td>
						</tr>
						<tr>
							<td>First Name:</td>
							<td><input type="text" name="fname" value=" <?php if(isset($_POST['fname'])) echo $_POST['fname']; ?> "></td>
						</tr>
						<tr>
							<td>Last Name:</td>
							<td><input type="text" name="lname" value=" <?php if(isset($_POST['lname'])) echo $_POST['lname']; ?> "></td>
						</tr>
						<tr>
							<td>Major:</td>
							<td> 
								<?php

								$majors = array("CS", "SE", "ART", "EN", "CHEM", "BIO", "COMM", "PHY", "EDU", "MATH");

								dropDownMenu($majors, "majors", $_POST['majors']);
								?>
							</td>
						</tr>
						<tr>
							<td>Address:</td>
							<td><input type="text" name="address" value=" <?php if(isset($_POST['address'])) echo $_POST['address']; ?> "></td>
						</tr>
						<tr>
							<td>City:</td>
							<td><input type="text" name="city" value=" <?php if(isset($_POST['city'])) echo $_POST['city']; ?> "></td>
						</tr>
						<tr>
							<td>
								State:
							</td>
							<td>
								<?php

								$state = array('AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FM', 'FL', 'GA', 'GU', 'HI', 'ID',
									'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MH', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH',
									'NJ', 'NM', 'NY', 'NC', 'ND', 'MP', 'OH', 'OK', 'OR', 'PW', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX',
									'UT', 'VT', 'VI', 'VA', 'WA', 'WV', 'WI', 'WY', 'AE', 'AA', 'AP');

								dropDownMenu($state, "state", $_POST['state']);

								?>

							</td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="text" name="email" value=" <?php if(isset($_POST['email'])) echo $_POST['email']; ?> "></td>
						</tr>
						<tr>
							<td>Phone:</td>
							<td><input type="text" name="phone" value=" <?php if(isset($_POST['phone'])) echo $_POST['phone']; ?> "></td>
						</tr>
						<tr>
							<td><input type="hidden" name="role" value= <?php echo $role; ?>></td>
						</tr>
						<tr>
							<td><input type="submit" name="button" value="Register"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>

		<div id="footer">
			<p>Copyright 2015 Monmouth University</p>
		</div>
	</div>
</div>

</body>

</html>