<?php
if($_SERVER["REQUEST_METHOD"]=="POST")[
	include 'dbconnect.php';
	showUser();
}

function showUser()
{
	global $connect;
	$query = " Select * FROM USERS; ";

	$result = mysqli_query($connect, $query);
	$num_of_rows = mysqli_num_rows($result);

	$tarray = array();

	if($num_of_rows > 0){
		while($row = mysqli_fetch_assoc($result)){
		$tarray[] = $row;
		}
	}

	header('Content-Type: application/json');
	echo json_encode(array("Users"=> $tarray));
	mysqli_close($connect);
}

?>