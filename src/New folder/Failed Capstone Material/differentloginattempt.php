<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
require 'dbconnect.php';
isUserGood();
}

function isUserGood()
{
       global $connect;
       $username = $_POST["username"];
       $password = $_POST["password"];
       $response = array();
       $response["success"] = false;
       $sql = 'SELECT username, password FROM Users WHERE username = "$username" AND password= "$password" ';
       echo $sql;
$result = $sql->query();
       if($result)
       {
         $response["success"] = true;
         echo $response;
       }
       else
       { 
         echo "Invalid Login"; 
       }
       
}
?>	