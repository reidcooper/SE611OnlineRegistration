<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/ xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!--

	James Reid Cooper
	SE-611
	3/13/15

-->

<head>
	<title>Online Registration</title>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" /> <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>

	<?php include("includes/header-admin.php"); ?>

	<div id="content"><!-- Start of the page-specific content. -->

		<h1>Update Your Account Password</h1>
		<br></br>

		<div style ="color: red">

			<?php
				// when the form in this page is submitted
				// If the request is a POST then update the user profile with the changed values
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				if($_POST['button'] == "Update") {

					$password = $_POST['password'];
					$confirm_password = $_POST['confirm_password'];
					$current_password = $_POST['current_password'];
					$uname = $_COOKIE['uname'];

					if (empty($password)){
						$error[] = "You forgot to enter password.";
					}
					if (empty($confirm_password)){
						$error[] = "You forgot to confirm your password.";
					}
					if (empty($current_password)){
						$error[] = "You forgot to enter your current password.";
					}
					if ($password != $confirm_password){
						$error[] = "Your passwords do not match.";
					}

					// Password Requirements
					// if( strlen($psword) < 8) {
					// 	$error[] = "Password too short!";
					// }

					// if( !preg_match("#[0-9]+#", $psword) ) {
					// 	$error[] = "Password must include at least one number! ";
					// }

					// Check to see if anything in $error.
					if (empty($error)){
						//Includes database connection file for authorization
						include("includes/db_connection.php");

						$q = "SELECT * FROM users WHERE uname = '$uname'";

						$r = mysqli_query($dbc, $q);

						if (mysqli_num_rows($r) == 1){
							$row = mysqli_fetch_array($r);
							if ($row['psword'] == SHA1($current_password)){


							// define a query
								$b = "UPDATE users SET psword=SHA1('$password') WHERE uname = '$uname'";

							// execute the query
								$r = mysqli_query($dbc, $b);
								if ($r) echo "Your Account Password Has Been Updated.";
								else echo "Sorry, failed connection";

							}
						} else {
							echo "Could Not Retrieve Account Information";
						}
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
						<td>Current Password:</td>
						<td><input type="password" name="current_password"></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td>Confirm Password:</td>
						<td><input type="password" name="confirm_password"></td>
					</tr>
					<tr>
						<td><input type="submit" name="button" value="Update"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<?php include("includes/footer.html"); ?>
</body>

</html>