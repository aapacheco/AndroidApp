<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
require 'dbconnect.php';
registerUser();
}

function registerUser()
{
	global $connect;
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$username = $_POST["username"];
	$password = $_POST["password"];
        $response = array();
	
		$sql = "SELECT * FROM users WHERE username='$username'";
		$check = mysqli_fetch_array(mysqli_query($connect,$sql));
		if(isset($check))
                {
			echo 'username already exist';
		}
                else
                {				
			$query = " Insert into users(firstname,lastname,username,password) values ('$firstname','$lastname','$username','$password');";
			if(mysqli_query($connect,$sql))
                        {
				echo 'successfully registered';
                                $response["success"] = true;
			}
                        else
                        {
				echo 'oops! Please try again!';
                                $response["success"] = false;
			}
		}

		mysqli_close($connect);
	}
}

?>