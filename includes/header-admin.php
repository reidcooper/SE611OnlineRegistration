<!--

	Week 5 of PHP

	1. Cookie
	2. classes.db
	3. Admin

-->

<!--

    James Reid Cooper
    SE-611
    3/25/15

    Week 8 of PHP

    1. Forgotten Password
    2. log_out.php
    3. created db log
    4. log_in function for index4.php

-->

<div id="header">
	<h1>Monmouth University Online Registration</h1>
	<h2>Where Leaders Look Forward</h2>
</div>

<div id="navigation">
	<ul>
		<li><a href="admin.php">Home Page</a></li>
		<li><a href="edit_profile_admin.php">Edit Profile</a></li>
		<li><a href="change_password_admin.php">Change Password</a></li>
		<li><a href="add_classes.php">Add Classes</a></li>
		<li><a href="edit_classes.php">Edit Classes</a></li>
		<li><a href="view_log.php">View Log</a></li>
	</ul>
</div>
<div id="content">
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

	// If the user role does not equal 1 (ADMIN) then redirect page back to index
	if ($_SESSION['role'] != 1 || !isset($_SESSION['role'])){
		header('LOCATION: index4.php');
	}
	?>
	<div id="log-out" align="right">
		<a href="includes/log_out.php">Log Out</a>
	</div>