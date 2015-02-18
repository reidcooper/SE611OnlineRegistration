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
	<?php include("includes/header.html"); ?>
	
	<div id="content"><!-- Start of the page-specific content. --> 
		<?php
			session_start();

			if(isset($_SESSION['uname'])){
				$uname = $_SESSION['uname'];
			} else {
				header('LOCATION: index4.php');
			}
		?>
	</div>
	<div id="footer">
		<p>Copyright 2015 Monmouth University</p>
	</div> 
</body> 

</html>