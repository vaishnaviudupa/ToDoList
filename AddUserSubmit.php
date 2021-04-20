
<?php
require_once('SQLFunctions.php');
session_start();

/* Check that username, and password are populated*/
if(!isset( $_POST['username'], $_POST['pwd']))
{
    $message = 'Please enter a valid username and password';
}
/* Check username length is not more than 20 and not less than 4*/
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
}
/* Check password length is not more than 20 and not less than 4*/
elseif (strlen( $_POST['pwd']) > 20 || strlen($_POST['pwd']) < 4)
{
    $message = 'Incorrect Length for Password';
}
/* Check the username for alpha numeric characters */
elseif (ctype_alnum($_POST['username']) != true)
{
    $message = "Username must be alpha numeric";
}
/* Check the password for alpha numeric characters */
elseif (ctype_alnum($_POST['pwd']) != true)
{
        $message = "Password must be alpha numeric";
}
else
{
    /* Store username and pwds as variable 
	For filter_var FILTER_SANITIZE_STRING function check out the link below:http://www.w3schools.com/php/filter_sanitize_string.asp
	This function (filter_var)removes special characters which can cause many issues including possible security risks.*/
    /*Use filter_var to remove special characters from the inputs*/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);

    /* Encrypt the password with sha1, a cryptographic hash function  */
    /* Never store plain text passwords in the database*/
    $pwd = sha1( $pwd );
	
	try
    {
         /*Connect to CRUD Database  mysqli(Server,User,Password,Database)*/
        $link = connectDB();

        /* Check that username does not already exist */
        $sql = "SELECT 1 FROM User_Dfn WHERE username = '".$username."'";
        if($result=mysqli_query($link,$sql)) 
        {
            if(mysqli_num_rows($result)>=1) {
              $message = "Username already exists";
            } else {
              /* Prepare the sql insert statement */
              $sql = "INSERT INTO User_Dfn (username, pwd ) VALUES ('".$username."', '".$pwd."')";
              if (mysqli_query($link, $sql)) {
                $message = 'New user added';
              } else { echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);  }
            }
        }
    }
    catch(Exception $e)
    {
        $message = 'Unable to process request';
    }
}
?>

<html>
  <head>
    <title>Add New User</title>
  </head>
  <body>
    <!-- Message is a variable that was populated previously based on the php above  -->    
    <p><?php echo $message; ?>
  </body>
</html>
