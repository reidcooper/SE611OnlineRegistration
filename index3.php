<!-- SE611

	James Reid Cooper
	Assignment 2
	2/13/15

	Week 3 of PHP
	1. create db, tables
	2. connect to db
	3. create register.php
	4. insert user info to table users

-->

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

		<div id="main">

			<div style ="color: red">

				<?php
				echo $diff;
				echo '<br>';

				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if($_POST['button'] == "Login") {

						$uname = $_POST['uname'];
						$psword = $_POST['psword'];

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
							$dbc = mysqli_connect('localhost', 'root', 'password', 'registration') or die ("Cannot connect to database.");
							
							$q = "SELECT * FROM users WHERE uname = '$uname'";

							$r = mysqli_query($dbc, $q);

							if (mysqli_num_rows($r) == 1){
								$row = mysqli_fetch_array($r);
								$check_count = $row['login_attempts'];
								$last_attempt = $row['last_attempt'];

								// Check the time difference between last attempt time vs now time
								$diff = abs(strtotime($last_attempt) - strtotime(date('Y-m-d H:i:s')));
								$criteria = 300; //time to have the user wait (seconds) 300 = 5 minutes

								// If the time difference is greater than the criteria of login attempt time frame,
								// then the check_count resets to 0 so the user CAN login again based on their account
								//
								// If the time difference is less than the criteria of login attempt time frame,
								// then the check_count remains 3 or above so the user CANNOT login again
								if ($diff > $criteria) {
									$check_count = 0;
								}

								// User gets 3 chances to enter in the correct username password
								if ($check_count < 3){
									if ($row['psword'] == SHA1($psword)){

										echo "This is a valid user.";

									// define a query
										$q = "UPDATE users SET login_attempts=0, last_login=NOW() WHERE uname = '$uname'";

									// execute the query
										$r = mysqli_query($dbc, $q);
										if ($r) echo " Successful Login to Database.";
										else echo " Sorry, failed connection.";

									} else {
										echo " Wrong Password";

										$check_count = $check_count + 1;

									// define a query
										$q = "UPDATE users SET login_attempts='$check_count', last_attempt=NOW() WHERE uname = '$uname'";

									// execute the query
										$r = mysqli_query($dbc, $q);
										if ($r) echo " - Attempts Left: ".(3-$check_count);
										else echo " Sorry, failed connection.";

									} 
								}  else {
									echo '<br>';
									echo "You are blocked from accessing the system. You need to wait for ".gmdate("i:s", ($criteria-$diff))." (mm:ss) minutes.";
								} 

							} else {
								echo "Wrong Username";
							}
						}  else {
							foreach ($error as $msg) {
								echo $msg;
							}
						}
					}

					if($_POST['button'] == "Register"){

						$role = $_POST['role'];
						if(empty($role)){
							echo '<br>';
							echo 'Please Enter Role';
						} else {
							header('LOCATION: register.php?role='.$role);
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
							<td><input type="submit" name="button" value="Login"></td>
						</tr>
					</table>
				</form>
				<form action="" method="POST">
					<table style="padding: 0px 290px">
						<tr>
							<td>Role: </td>
							<td>
								Admin <input type="radio" name="role" value="Admin">
								Student <input type="radio" name="role" value="Student">
							</td>
						</tr>
					</table>
					<div style="padding: 0px 290px">
						<td><input type="submit" name="button" value="Register"></td>
					</div>
				</form>
			</div>

			<div id="footer">
				<p>Copyright 2015 Monmouth University</p>
			</div>
		</div>

	</body>

	</html>