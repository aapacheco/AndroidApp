<?php
$server_name = "mysql12.000webhost.com";
$username = "a4000374_tony";
$password = "Capstone16";
$DB_Name = "a4000374_Clients";
$connect = mysqli_connect($server_name, $username, $password, $DB_Name);

if($connect)
{ echo "connection success"; } else { echo "connection failure"; }
?>