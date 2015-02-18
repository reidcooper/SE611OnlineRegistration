<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/ xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!--

	Week 4 of PHP

	1. edit_profile.php
	2. Header/Footer
	3. student.php
	4. index4.php

-->


<head>
	<title>Page Title</title>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" /> <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head> 

<body>
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

	<?php include("includes/header.html"); ?>

	<div id="content"><!-- Start of the page-specific content. --> 
		
		<h1>Update Your Account Information</h1>
		<br></br>

		<?php

		// Maintain the session that is being used by a particular USER
		session_start();

		if(isset($_SESSION['uname'])){
			$uname = $_SESSION['uname'];
		} else {
			header('LOCATION: index4.php');
		}
		?>

		<div style ="color: red">

			<?php
				// when the form in this page is submitted
				// If the request is a POST then update the user profile with the changed values
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				if($_POST['button'] == "Update") {

					$fname = $_POST['fname'];
					$lname = $_POST['lname'];
					$major = $_POST['majors'];
					$address = $_POST['address'];
					$city = $_POST['city'];
					$state = $_POST['state'];
					$email = $_POST['email'];
					$phone = $_POST['phone'];

					// Define an array of error
					$error = array();

					if (empty($uname)){
						$error[] = "You forgot to enter username.";
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

						// Check to see if anything in $error.
					if (empty($error)){

							// DB Connection
						$dbc = mysqli_connect('localhost', 'root', 'password', 'registration') or die ('Not Connected');

							// define a query
						$q = "UPDATE users SET fname= '$fname', lname='$lname', major='$major', address='$address', city='$city', state='$state', email='$email', phone='$phone' WHERE uname = '$uname'";

							// execute the query
						$r = mysqli_query($dbc, $q);
						if ($r) echo "The record is updated to the DB.";
						else echo "Sorry, failed connection";

					} else {
						foreach ($error as $msg) {
							echo $msg;
							echo '<br>';
						}
					}
				}
			// This is for calling the values from the database from the user profile that is being used
			} else {
				$dbc = mysqli_connect('localhost', 'root', 'password', 'registration') or die ("Cannot connect to database.");

				$q = "SELECT * FROM users WHERE uname = '$uname'";

				$r = mysqli_query($dbc, $q);

				if (mysqli_num_rows($r) == 1){
					$row = mysqli_fetch_array($r);
					$fname = $row['fname'];
					$lname = $row['lname'];
					$major = $row['major'];
					$address = $row['address'];
					$city = $row['city'];
					$state = $row['state'];
					$email = $row['email'];
					$phone = $row['phone'];
				}else {
					echo "Could Not Retrieve Account Information";
				}
			}
			?>

		</div>

		<div id="registration-form">
			<form action="" method="POST">
				<table align="center">
					<tr>
						<td>First Name:</td>
						<td><input type="text" name="fname" value=" <?php echo $fname?> "></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><input type="text" name="lname" value=" <?php echo $lname?> "></td>
					</tr>
					<tr>
						<td>Major:</td>
						<td> 
							<?php

							$majors_1 = array("CS", "SE", "ART", "EN", "CHEM", "BIO", "COMM", "PHY", "EDU", "MATH");

							dropDownMenu($majors_1, "majors", $major);
							?>
						</td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><input type="text" name="address" value=" <?php echo $address?> "></td>
					</tr>
					<tr>
						<td>City:</td>
						<td><input type="text" name="city" value=" <?php echo $city?> "></td>
					</tr>
					<tr>
						<td>
							State:
						</td>
						<td>
							<?php

							$state_1 = array('AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FM', 'FL', 'GA', 'GU', 'HI', 'ID',
								'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MH', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH',
								'NJ', 'NM', 'NY', 'NC', 'ND', 'MP', 'OH', 'OK', 'OR', 'PW', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX',
								'UT', 'VT', 'VI', 'VA', 'WA', 'WV', 'WI', 'WY', 'AE', 'AA', 'AP');

							dropDownMenu($state_1, "state", $state);

							?>

						</td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="email" value=" <?php echo $email?> "></td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td><input type="text" name="phone" value=" <?php echo $phone?> "></td>
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