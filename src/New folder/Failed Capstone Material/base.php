<?php
session_start();
 
$dbhost = "mysql12.000webhost.com"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "a4000374_Clients"; // the name of the database that you are going to use for this project
$dbuser = "a4000374_tony"; // the username that you created, or were given, to access your database
$dbpass = "Capstone16"; // the password that you created, or were given, to access your database
 
mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
?>