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

<?php
    // Maintain the session that is being used by a particular USER
session_start();

    // If there is no cookie with a username, redirect to Index
    // Else set the cookies to the username and first name for personal greeting (possibly)
if(empty($_COOKIE['uname'])){
    header('LOCATION: ../index4.php');
} else {
    $uname = $_COOKIE['uname'];
    $fname = $_COOKIE['fname'];
}

// If the user role does not equal 0 (Student) then redirect page back to index
if (!isset($_SESSION['role'])){
    header('LOCATION: ../index4.php');
} else {

//Includes database connection file for authorization
    include("db_connection.php");

    $action = "Log Out";

// define a query
    $q = "INSERT INTO log (uname, time, action) VALUES ('$uname', now(), '$action')";

// execute the query
    $r = mysqli_query($dbc, $q);
    if ($r){
        header('LOCATION: ../index4.php');
    }
    else {
        echo "Sorry, failed connection";
    }
}
?>