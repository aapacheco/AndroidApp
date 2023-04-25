<?php
  header('Content-Type: application/json');

  $response = array();

  $mysqli = new mysqli("thisinstance.cy3jxhjvzmqz.us-east-1.rds.amazonaws.com:3306", "Muser", "mpassword", "MyDB");

  /* check connection */
  if (mysqli_connect_errno()) {

      $response["DCE"] = mysqli_connect_error();
      echo json_encode($response);
      exit();

  }

  if(isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["Username"]) && isset($_POST["Password"]))
	{
		$FirstName = (string)$_POST["FirstName"];
		$LastName  = (string)$_POST["LastName"];
		$Username  = (string)$_POST["Username"];
		$Password  = (string)$_POST["Password"];
		$Access = (int) 1;
		$BarcodeValue = (int) rand(48,10048);

    if ($FirstName && $LastName && $Username && $Password) {

      /* create a prepared statement */
      if ($stmt = $mysqli->prepare("SELECT Username FROM users WHERE Username=?")) {

        /* bind parameters for markers */
        if ($stmt->bind_param("s", $Username)) {

          /* execute query */
          if ($stmt->execute()) {

            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {

              $response["UAE"] = "User already exists";
              $result->free();
              $stmt->close();

            } else {
              
              $result->free();
              $stmt->close();
		
		randvalcheck($BarcodeValue);

              if ($stmt = $mysqli->prepare("INSERT INTO users (Username,Password,FirstName,LastName,BarcodeValue,Access) values (?,?,?,?,?,?)")) {

                if ($stmt->bind_param("ssssii", $Username, $Password, $FirstName, $LastName, $BarcodeValue, $Access)) {

                  if ($stmt->execute()) $response["SR"] = "Successful registration";

                  else $response["QE"] = "Query 2 did not execute properly";

                } else $response["QE"] = "Query 2 parameters could not be bound";

              } else $response["QE"] = "Query 2 could not be prepared";

            }

          } else $response["QE"] = "Query 1 did not execute properly";

        } else $response["QE"] = "Query 1 parameters could not be bound";

      } else $response["QE"] = "Query 1 could not be prepared";

    } else $response["BR"] = "Bad POST request parameters";
    
  } else $response["BR"] = "Bad POST request parameters";

  /* close connection */
  $mysqli->close();
  echo json_encode($response);

?>

function randvalcheck($BarcodeValue)
{
	if ($stmt = $mysqli->prepare("SELECT BarcodeValue FROM users WHERE BarcodeValue=?")) 
	{
        	if ($stmt->bind_param("i", $BarcodeValue)) 
		{
          		if ($stmt->execute()) 
			{
				$result = $stmt->get_result();
            			if ($row = $result->fetch_assoc()) 
				{
					$BarcodeValue = (int) rand(48,10048);
					randvalcheck($BarcodeValue);
	   			}
			}
		}
	}
}
