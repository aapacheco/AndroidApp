<?php
    require("password.php");
    $connect = mysqli_connect("mysql12.000webhost.com", "a4000374_tony", "Capstone16", "a4000374_Clients");
    
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $uname = $_POST["username"];
    $pword = $_POST["password"];
     function registerUser() {
        global $connect, $fname, $lname, $uname, $pword;
        $passwordHash = password_hash($pword, PASSWORD_DEFAULT);
        $statement = mysqli_prepare($connect, "INSERT INTO user (firstname, lastname, username, password) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "siss", $fname, $lname, $uname, $passwordHash);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);     
    }
    function usernameAvailable() {
        global $connect, $username;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $uname);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
        if ($count < 1){
            return true; 
        }else {
            return false; 
        }
    }
    $response = array();
    $response["success"] = false;  
    if (usernameAvailable()){
        registerUser();
        $response["success"] = true;  
    }
    
    echo json_encode($statement); /* previously $firstname $lastname $username $password instead of $fname $lname $uname $pword*/
?>