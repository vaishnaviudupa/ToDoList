<html>
<head>
<title>CRUD Login</title>
</head>

<body>
  <h2>CRUD Login</h2>
  <form action="LoginSubmit.php" method="post">
  <fieldset>
    <p>
      <label>Username</label>
      <input type="text" name="username" value="" maxlength="20" />
    </p>
    <p>
      <label>Password</label>
      <input type="password"  name="pwd" value="" maxlength="20" />
    </p>
    <p>
      <input type="submit" value="Login" />
    </p>
  </fieldset>
  </form>
</body>
</html>