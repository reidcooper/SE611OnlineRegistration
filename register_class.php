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
3. delete_class

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

// If the user role is not set as 0(Student) then redirect page back to index
if ($_SESSION['role'] != 0 || !isset($_SESSION['role'])){
	header('LOCATION: index4.php');
} else {
	if(isset($_GET['id'])){

		$class_id = $_GET['id'];

		//Includes database connection file for authorization
		include("includes/db_connection.php");

	// define a query
		$b = "SELECT * FROM registration WHERE uname = '$uname' AND class_id = '$class_id'";
		$s = mysqli_query($dbc, $b);

	// Returns if it obtain any rows
		$test = mysqli_num_rows($s);

	// If $test = 0 then there are no matches which is good
		if($test == 0){
		// define a query
			$q = "INSERT INTO registration (class_id, reg_date, uname) VALUES ('$class_id', now(), '$uname')";
			$r = mysqli_query($dbc, $q);

			if($r){
				$message = "Congratulations on Registering!";
				header('LOCATION: register_classes.php?message='.$message.'');
			} else {
				echo "Cannot Add Record.";
			}
		} else {
			$message = "You Are Already Registered for that Class";
			header('LOCATION: register_classes.php?message='.$message.'');
		}


	}
}

?>