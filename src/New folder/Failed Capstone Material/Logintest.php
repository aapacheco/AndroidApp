function protect($string){
    $string = trim(strip_tags(addslashes($string)));
    return $string;
}

if($_POST['submit']){
    $username = protect($_POST['username']);
    $password = protect($_POST['password']);
    if(!$username || !$password){
        //if not display an error message
        echo "<script> alert('No data entered') </script>";
        echo "<script type='text/javascript'>document.location.href='index.php';</script>";

    }else{
        //if the were continue checking
        //select all rows from the table where the username matches the one entered by the user
        $res = mysql_query("SELECT * FROM `users` WHERE `username` = '".$username."'");
        $num = mysql_num_rows($res);
        //check if there was not a match
        if($num == 0){
            //if not display an error message
            echo "<script> alert('User does not exist') </script>";
            echo "<script type='text/javascript'>document.location.href='index_spa.php';</script>";

        }else{
            //if there was a match continue checking
            //select all rows where the username and password match the ones submitted by the user
            $res = mysql_query("SELECT * FROM `users` WHERE `username` = '".$username."' AND `password` = '".$password."'");
            $num = mysql_num_rows($res);
            //check if there was not a match
            if($num == 0){
                //if not display error message
                echo "<script> alert('Invalid Password') </script>";
                echo "<script type='text/javascript'>document.location.href='index.php';</script>";
            }else{
                //if there was continue checking
                //split all fields fom the correct row into an associative array
                $row = mysql_fetch_assoc($res);
                //check to see if the user has not activated their account yet
                if($row['active'] != 1){
                    //if not display error message
                    echo "<script> alert('Your account " . $username . " is not activated yet.') </script>";
                    echo "<script type='text/javascript'>document.location.href='index_spa.php';</script>";

                }else{
                    //if they have log them in
                    //set the login session storing there id - we use this to see if they are logged in or not
                    $_SESSION['uid'] = $row['id'];
                    //show message
                    echo "<script type='text/javascript'>document.location.href='index.php?u=" . $username . "';</script>";
                }
            }
        }
    }
}