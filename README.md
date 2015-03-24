# SE-611 Online Registration System
====

This repo holds my code for the SE611 Secure Web Service class. The Online Registration system is an on-going semester project/assignment for the class.

I am learning PHP for the first time so this has become good practice and learning for me but has also been a fun experience. Some of the HTML/CSS code I have came from the book for the class (PHP and MySQL for Dynamic Web Sites 4th Edition - Larry Ullman).

I also used my created vagrant script to set up the development environment. If you would like to use the vagrant set up script, [click here!](https://github.com/reidcooper/BasicVagrantLAMPSetup)

** Make sure you create a database for this, as of now, I have no provided the schema for the database. If you desire it, just email me. I will update it later towards the end of the semester. **

### Database Connection File

There is a `includes/db_connection.php` file which has not been included but is required at least for my configuration. Here is a sample of the `includes/db_connection.php` file.

```
<?php
// LOCAL
$db_servername = "localhost";
$db_username = "root";
$db_password = "password";
$db_dbname = "registration";

// Create connection
// DB Connection
// $dbc = mysqli_connect('localhost', 'root', 'password', 'registration') or die ("Cannot connect to database.");
$dbc = mysqli_connect($db_servername, $db_username, $db_password, $db_dbname) or die ('Not Connected');

// Check connection
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}
?>
```