<?php      
include('session.php');
?>

<?php      
  include('SQLFunctions.php');

   /*The Read page ToDoApp.php is going to link to this page by sending an html form POST 
   with the ToDoID as the only input. We could name it anything. In this case, we named it "q" */
   $q=$_POST["q"];
   
   /*Open the database connection based on config.php file settings*/
   $link = connectDB();
   
    /*Create the Sql Statement*/
    /*$sql = "SELECT ToDoID, ToDoTitle, ToDoDescription, ToDueDate FROM ToDos WHERE ToDoID = 5";  */ 
    $sql = "SELECT ToDoID, ToDoTitle, ToDoDescription, ToDueDate FROM ToDos WHERE ToDoID =".$q;
    /*We will use the hard-coded sql statement for now*/
    echo '<br>sql :'.$sql.'<br>Comment this out, after testing<br><br>';
    
    
    /*If the $sql passes validation, exectute it*/
    if($stmt = $link->prepare($sql))
    {
        $stmt->execute();
        /*Assign the results into their respective php variables*/
        $stmt->bind_result($ToDoID, $ToDoTitle, $ToDoDescription, $ToDueDate);
        while ($stmt->fetch())
        {
          /*reformat the date to html*/
          $newToDueDate = date("Y-m-d", strtotime($ToDueDate));
          echo "<BODY>";
          echo "  <div>";
          echo "    <div>";
          echo "    <h1>Update To-do</h1>";
          /*Create and prepopulate an html form with the values pulled from the database.*/
          echo "    <form action='UpdateToDoCommit.php' method = 'POST' onsubmit='' />";
          echo "      <input type='hidden' name='ToDoId' value='".$ToDoID."'>";
          echo "      <p>To-do Title:  <input text='text' name='ToDoTitle' maxlength='50'  required value='".$ToDoTitle."'/></p>";
          echo "      <p>To-Due Date:  <input type='date' name='ToDueDate' value='".$newToDueDate."''></p>";
          echo "      <p>Description:<br> <textarea cols='100' rows='5' name='ToDoDesr' maxlength='1000'  required>".$ToDoDescription."</textarea></p>";
          echo "      <input type='submit'> ";
          echo "    </form>";
          echo "    <a href='ToDoApp.php'><button>Cancel</button></a>";
          echo "    </div>";
          echo "  </div>";
          echo "</BODY>";    
        }
    }
    else  { 
      echo 'Unable to connect'; 
      exit();
    }
?> 