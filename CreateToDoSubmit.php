<!--This file will receive the data from the html form and insert it into the database and then return the user back to the ToDoApp.php page

Insert the following into CreateToDoSubmit.php

Test this out, it should insert rows into the ToDo table, and then reroute the user to the ToDoApp.php-->

<?php      
include('session.php');
?>

<?php
include('SQLFunctions.php');

if ( !empty($_POST)) {
  // Store data from html form POST action into variables
  $tdTitle = $_POST['ToDoTitle'];
  $tdDate  = $_POST['ToDueDate'];
  $tdDescr = $_POST['ToDoDescription'];
  $user_id = $_SESSION['user_id'];
         
/*Open the database connection based on config.php file settings*/
  $link = connectDB();

  /*Prepare the SQL INSERT Statement*/
  $sql = "INSERT INTO ToDos (User_ID, ToDoTitle, ToDoDescription, ToDueDate, EntryTS) VALUES (".$user_id.",'".$tdTitle."','".$tdDescr."','".$tdDate."', NOW());";
  /*Insert values into the database*/
  if (mysqli_query($link, $sql)) {
  /*    echo "<br>New record created successfully";*/
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forward User Back to Main View*/  
header("Location: ToDoApp.php");

}

?>
