<?php
  header('Content-Type: application/json');

  $response = array();
$current = $_GET["state"]; // Declares the request from blah.html as a variable
  	
if ($current == 0)
  	{
$logout = $_POST["state"];
$response["LS"] = "Logout Successful";
echo json_encode($response);
}

?>