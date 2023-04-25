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

              if ($stmt = $mysqli->prepare("INSERT INTO users (Username,Password,FirstName,LastName) values (?,?,?,?)")) {

                if ($stmt->bind_param("ssss", $Username, $Password, $FirstName, $LastName)) {

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

