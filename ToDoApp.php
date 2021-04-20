<?php      
include('session.php');
?>

<?php
include('SQLFunctions.php');
$user_id = $_SESSION['user_id'];
?>
<html>
<!--The Style tag allows us to put some basic css shading and borders to make the table a little easier to look at. Table, th and td are elements of an html table.-->
<head>
<style>
  table, th, td { border: 1px solid black;
                  border-collapse: collapse;
				  width: 100%;}
  table th { width: 100%;
			background-color: black;
             color: white; }    
  table tr:nth-child(even) { background-color: #eee; }
  table tr:nth-child(odd)  { background-color: #fff; }

</style>
</head>  
<body>
      <h1>To-do Main View</h1>
      <a href="CreateToDo.php"><button>New To-do</button></a>
<?php      
  /*Create the SQL Statement, selecting the four columns were are interested in*/
  /*format the date to display it easier*/
  $sql="SELECT ToDoTitle
                ,ToDoDescription
                ,DATE_FORMAT(ToDueDate,'%m-%d-%Y')  
                ,ToDoID
          FROM ToDos
		  WHERE User_ID = ".$user_id;
  /*echo '<br>sql :'.$sql.'<br>Comment this out, after testing<br><br>';*/
 
   /*Open the database connection based on config.php file settings*/
  $link = connectDB();

  /*Execute the sql and if there is a result, write out the table headers, then rows*/
  if ($result = mysqli_query($link,$sql)){
      echo "<table>";
        //header
        echo "<tr>";
          echo "<th>Title</td>";
          echo "<th>Description</td>";
          echo "<th>DueDate</td>";
          echo "<th>Action</td>";   
        echo "</tr>";
      
      //rows, use a while loop to write out each field in the result set.
      //mysqli_fetch_array() separates the results into an array named  $row so 
      //that each field can be referrenced using $row[x]
      while ($row = mysqli_fetch_array($result))  {
        echo "<tr>";
          echo "<td>{$row[0]}</td>";
          echo "<td>{$row[1]}</td>";
          echo "<td>{$row[2]}</td>";
          echo "<td><form action='UpdateToDo.php' method = 'POST' onsubmit='' /> 
		  <input type='hidden' name='q' value='".$row[3]."' /><input type='Submit' value='Update'></form>";
		  echo "<form action='DeleteToDo.php' method = 'POST' onsubmit='' /> 
		  <input type='hidden' name='q' value='".$row[3]."' /><input type='Submit' value='Delete'></form></td>";
        echo "</tr>";
      } 
      echo "</table>";
    }
    
  /*Close database connection*/
  mysqli_close ( $link );
?>
</body>
</html>