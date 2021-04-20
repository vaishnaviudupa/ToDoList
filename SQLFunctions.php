<?php
include('config.php');

function connectDB() {
  /*mysqli is a php function that requires the database hostname, database name, username and password in order to create a database connection*/
  $link = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
  if ($link->connect_error) {
               /*if an error occurs while establishing the connection, stop processing and 
               write out an error message*/
    die("Connection failed: " . $link->connect_error);
  } 
  echo "<br>Connected successfully to the database<br><br>"; 

/*return defines what gets sent back when the function completes.  In this case, a database connection variable named $link*/
  return $link;
}
?>