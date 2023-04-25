<?php
  header('Content-Type: application/json');

  $response = array();

  $mysqli = new mysqli("thisinstance.cy3jxhjvzmqz.us-east-1.rds.amazonaws.com:3306", "Muser", "mpassword", "MyDB");

  /* check connection */
  if (mysqli_connect_errno()) 
  {
    $response["DCE"] = mysqli_connect_error();
    echo json_encode($response);
    exit();
  }
  
  if(isset($_POST["Username"]) && isset($_POST["Password"]))
	{	
    		$Username  = (string)$_POST["Username"];
		$Uname = $Username;
		$Password  = (string)$_POST["Password"];
  	if ($Username && $Password)
  	{
  		if ($stmt = $mysqli->prepare("SELECT * FROM users WHERE Username=? AND Password=?"))
  		{
  			if ($stmt->bind_param("ss", $Username, $Password))
  			{
  				if ($stmt->execute())
  				{
					$result = $stmt->get_result();
					if ($row = $result->fetch_assoc()) 
					{
						$BV = $row["BarcodeValue"];
  						$response["SL"] = "Successful Login";
                				$BarcodeValue = (int) rand(48,10048);
						randvalcheck($BarcodeValue);
                				if ($stmtBV = $mysqli->prepare("UPDATE users SET BarcodeValue=? WHERE Username='$Uname'"))
  						{
  	       						if ($stmtBV->bind_param("i", $BarcodeValue))
  		 					{
  								if ($stmtBV->execute())
  		       						 {
									$result->free();
								 }
							}else{$response["PNB"] = "Parameters Could Not Be Bound";}
						}else{ $response["BVE"] = "Barcode Value Error";}

              				} else $response["BUP"] = "Bad username or password";
            
  				} else $response["QE"] = "Query did not execute properly";
          
        } else $response["QE"] = "Query parameters could not be bound";
        
        /* close statement */
        $stmt->close();
        
      } else $response["QE"] = "Query could not be prepared";
      
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