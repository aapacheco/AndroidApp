<?php
  header('Content-Type: application/json');

  $response = array();

$logout = $_GET["state"]; // Declares the request from blah.html as a variable
  	
if ($logout == 0)
  	{
$response["LS"] = "Logout Successful";
echo json_encode($response);
}

?>