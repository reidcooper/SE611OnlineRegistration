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
if ($_SESSION['role'] != 0 || !isset($_SESSION['role'])){
	header('LOCATION: index4.php');
} else {
	if(isset($_GET['id'])){

		$class_id = $_GET['id'];

		//Includes database connection file for authorization
		include("includes/db_connection.php");

		$q = "DELETE FROM registration WHERE class_id='$class_id'";

		$r = mysqli_query($dbc, $q);

		if($r){
			$message = "Successful Removal of Class!";
			header('LOCATION: deregister_classes.php?message='.$message.'');
		} else {
			echo "Cannot Delete Record.";
		}
	}
}

?>