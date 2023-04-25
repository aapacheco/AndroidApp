<?php
$mysqli = new mysqli("mysql12.000webhost.com", "a4000374_tony", "Capstone16", "a4000374_Clients");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$username = $_POST["username"];
$password = $_POST["password"];
$response = false

/* create a prepared statement */
if ($stmt = $mysqli->prepare("SELECT username, password FROM Users WHERE username=? AND password=? LIMIT 1")) {

    /* bind parameters for markers */
    $stmt->bind_param('ss', $username, $password);

    /* execute query */
    $result = $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($result);

    /* fetch value */
    if($stmt->fetch())
    {
        $response = true;
    }
    /* close statement */
    $stmt->close();
    return $response;
}

/* close connection */
$mysqli->close();
?>	