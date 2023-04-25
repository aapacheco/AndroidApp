<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
require 'dbconnect.php';
loginUser();
}

function loginUser()
    {
	global $connect;
	$username = $_POST["username"];
	$password = $_POST["password"];
	$response = array();

if($username == '' || $password == ''){
		echo 'please fill all values';
}else{

	$sql = "SELECT * FROM users WHERE username= '$username' AND password= '$password'";
		
	$check = mysqli_fetch_array(mysqli_query($connect,$sql));
		
	if(isset($check)){
    		$response["success"] = true;
		header('Content-Type: application/json');
		echo json_encode(array("Users"=> $response));
		mysqli_close($connect);

	}else{
	$response["success"] = false;
	}


}
?>