if(!empty($_POST['username']) && !empty($_POST['password']))
{
    $fname = mysql_real_escape_string($_POST['firstname']);
    $lname = mysql_real_escape_string($_POST['lastname']);
    $username = mysql_real_escape_string($_POST['username']);
    $password = md5(mysql_real_escape_string($_POST['password']));

     
     $checkusername = mysql_query("SELECT * FROM users WHERE Username = '".$username."'");
      
     if(mysql_num_rows($checkusername) == 1)
     {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
     }
     else
     {
        $registerquery = mysql_query("INSERT INTO users ( Firstname, Lastname, Username, Password) VALUES('".$fname."', '".$lname."', '".$username."', '".$password."')");
        if($registerquery)
        {
            echo "<h1>Success</h1>";
            echo "<p>Your account was successfully created. Please <a href=\"index.php\">click here to login</a>.</p>";
        }
        else
        {
            echo "<h1>Error</h1>";
            echo "<p>Sorry, your registration failed. Please go back and try again.</p>";    
        }       
     }
}