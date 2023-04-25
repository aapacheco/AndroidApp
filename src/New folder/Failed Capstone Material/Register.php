<?php
    
    $con = mysqli_connect("mysql12.000webhost.com", "a4000374_tony", "Capstone16", "a4000374_Clients");
    
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $statement = mysqli_prepare($con, "INSERT INTO user (firstname, lastname, username, password) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, "siss", $firstname, $lastname, $username, $password);
    mysqli_stmt_execute($statement);

      
  
    $response = array();
    $response["success"] = true;  
    
    echo json_encode($response);
?>