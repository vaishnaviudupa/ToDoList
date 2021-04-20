
<!--To update the database, create a new file titled UpdateToDoCommit.php-->
<?php      
include('session.php');
?>

<?php      
include('SQLFunctions.php');

// If there is anything in the POST, store the data from the form into variables
if ( !empty($_POST)) {
  $tdID = $_POST['ToDoId'];
  $tdTitle = $_POST['ToDoTitle'];
  $tdDate  = $_POST['ToDueDate'];
  $tdDescr = $_POST['ToDoDesr'];
         
  /*Open the database connection based on config.php file settings*/
  $link = connectDB();

  /*Prepare the SQL INSERT Statement*/
  $sql = "UPDATE ToDos
          SET ToDoTitle = '".$tdTitle."'
             ,ToDoDescription = '".$tdDescr."'
             ,ToDueDate ='".$tdDate."'
             ,UpdateTS =  NOW()
          WHERE ToDoId = ".$tdID.";";
  echo $sql."<br>Comment this out, once tested"; 
  
  /*Insert values into the database*/
  if (mysqli_query($link, $sql)) {
      echo "<br>Update record successfully";
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forwarded User Back to Main View*/  
header("Location: ToDoApp.php"); /* Uncomment this after testing */

}

?>