<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/ xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
	<title>Page Title</title>
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" /> <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head> 

<body>
	<?php include("includes/header-admin.html"); ?>
	
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

			if ($_SESSION['role'] == 0){
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
	<?php include("includes/footer.html"); ?> 
</body> 

</html>