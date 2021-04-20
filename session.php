<?php

/*This page will load at the beginning of the other pages. It will redirect users to the login page if they haven’t yet authenticated.*/
  
session_start();

if(!isset($_SESSION['user_id']))
{
    /* Redirect If Not Logged In */
    header("Location: Login.php");
    exit; /* prevent other code from being executed*/
} else {
  /*we are going to start tracking a new session variable we will call timeout.
   by comparing the session timeout plus 600 seconds to the current time, 
   we can force users to the logout page when they attempt to access the page, after 10 mins of inaction*/
  if ($_SESSION['timeout'] + 10 * 60 < time()) {
    /* session timed out */
    header("Location: Logout.php");
  } else {
    /*if the user isn't timed out, update the session timeout variable to the current time.*/
     $_SESSION['timeout'] = time();
  }
}
?>
<!-- The following navigation links are for convenience  -->
<div align="right">
  <a href="ToDoApp.php">Home</a>
  <a href="AddUser.php">New User</a>
  <a href="Login.php">Log On</a>
  <a href="Logout.php">Log Off</a>
  <a href="TestLoginStatus.php">Test Login Status</a>
</div> 