<?php
  header('Content-Type: application/json');

  $response = array();

  $mysqli = new mysqli("thisinstance.cy3jxhjvzmqz.us-east-1.rds.amazonaws.com", "Muser", "mpassword", "MyDB");

  /* check connection */
  if (mysqli_connect_errno()) 
  {
      $response["DCE"] = mysqli_connect_error();
      echo json_encode($response);
      exit();
  }
  	if(isset($_POST["BarcodeValue"]))
	{	$BV  = (int)$_POST["BarcodeValue"];
		$AC  = (int)1;
  	if ($BV)
  	{
  		if ($stmt = $mysqli->prepare("SELECT * FROM users BarcodeValue) values (?)"))
  		{
  			if ($stmt->bind_param("ii", $BV, $AC))
  			{
  				if ($stmt->execute())
  				{
  					$response["UHA"] = "User Has Access";
  					
  				}
  				else {
  					$response["QE"] = "Query did not execute properly";
  					
  				}
              		} 
              		else 
              			$response["QE"] = "Query parameters could not be bound";
            	} 
            	else
            		$response["QE"] = "Query could not be prepared";
		
      		/* close statement */
      		$stmt->close();
  	 } else $response["BR"] = "Bad POST request parameters";
    
  } else $response["BR"] = "Bad POST request parameters";

  /* close connection */
  $mysqli->close();
  echo json_encode($response);

?>