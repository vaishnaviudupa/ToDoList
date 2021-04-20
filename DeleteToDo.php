<!--This file will take the input from a POST, and delete the corresponding ToDo row.-->
<?php      
include('session.php');
?>

<?php
  include('SQLFunctions.php');

/*if anything is in the Post, assign the $tdID variable with the ID from the post*/
if ( !empty($_POST)) {
  $tdID = $_POST['q'];
   /*Open the database connection based on config.php file settings*/
  $link = connectDB();
	echo "hi";
  /*Prepare the SQL Delete Statement using the ID from the POST*/
  $sql = "DELETE
          FROM ToDos
          WHERE ToDoId = ".$tdID.";";
  echo "sql:".$sql." Comment this out after testing"; 
  
  /*Attempt Delete*/
  if (mysqli_query($link, $sql)) {
      echo "<br>Delete record successfully";
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forwared User Back to Main View*/ 
/*header("Location: ToDoApp.php");  uncomment this after testing*/
}
?>