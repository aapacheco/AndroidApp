<?php
    $con = mysqli_connect("mysql12.000webhost.com", "a4000374_tony", "Capstone16", "a4000374_Clients");
    
    $uname = $_POST["username"];
    $pword = $_POST["password"];
    
    $statement = mysqli_prepare($con, "SELECT * FROM user WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($statement, "ss", $uname, $pword);
    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $UserID, $fname, $lname, $uname, $pword);
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
            $response["success"] = true;
            $response["firstname"] = $fname;
            $response["lastname"] = $lname;
            $response["username"] = $uname;
            $response["password"] = $pword;
    }
    echo json_encode($response);
?>