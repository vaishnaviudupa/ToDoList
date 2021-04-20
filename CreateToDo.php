<?php      
include('session.php');
?>

<HTML>
  <HEAD>
    <TITLE>CreateToDo</TITLE>
    <META http-equiv=Content-Type content="text/html; charset=utf-8">
    <script type="text/javascript"> 
      function validateForm(){
        //this is just a placeholder incase we wanted add additional javascript type validations.
        return true;
      };             
    </script>
  </HEAD> 
  <BODY>
    <h1>New To-do</h1>
      <form action="CreateToDoSubmit.php" method="POST" onsubmit='return validateForm()' />
        <p>To-do Title:  <input type="text" name="ToDoTitle" maxlength='50' required/></p>
        <p>To-Due Date:  <input type="date" name="ToDueDate"></p>
        <p>Description:<br> <textarea cols="100" rows="5" name="ToDoDescription" maxlength='1000' required>      </textarea></p>  
        <input type="submit">       
      </form>
  </BODY>
</HTML>