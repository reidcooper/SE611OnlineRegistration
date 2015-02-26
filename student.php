<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/ xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!--

	Week 4 of PHP

	1. edit_profile.php
	2. Header/Footer
	3. student.php
	4. index4.php

-->

<!--

	Week 5 of PHP

	1. Cookie
	2. classes.db
	3. Admin

-->

<head>
	<title>Page Title</title>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" /> <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head> 

<body>
	<?php include("includes/header-student.html"); ?>
	
	<div id="content"><!-- Start of the page-specific content. --> 
		<?php

			// If cookie is not set then redirect page to index
			// Otherwise set username to the logged in username
			// Will not work because its not in an official server

			// Maintain the session that is being used by a particular USER
			session_start();

			if(empty($_COOKIE['uname'])){
				header('LOCATION: index4.php');
			} else {
				$uname = $_COOKIE['uname'];
				$fname = $_COOKIE['fname'];
			}

			if ($_SESSION['role'] == 1){
				header('LOCATION: index4.php');
			}

			// session_start();

			// if(isset($_SESSION['uname'])){
			// 	$uname = $_SESSION['uname'];
			// } else {
			// 	header('LOCATION: index4.php');
			// }
		?>
	</div>
	<h1>Welcome, <?php echo $fname." (".$uname.")" ?></h1>
	<div id="footer">
		<p>Copyright 2015 Monmouth University</p>
	</div> 
</body> 

</html>