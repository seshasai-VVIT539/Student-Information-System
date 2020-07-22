<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Student Information System</title>
  <meta name="Description" content="Project Approval System">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .loginmessage{
        background-color: rgb(255,232,232);
        color: red;
        display:none;
        font-size: 14px;
        font-weight: bold;
    }
  </style>
</head>

<body>
  <header class="header">
    <h1 class>Student Information System</h1>
  </header>
  <form action="login_action.php" method="post">
    <div class="imgcontainer">
      <img src="img\clg_logo.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <button type="submit">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
    <p class="loginmessage">Incorrect username and password</p>
      <span class="psw">Forgot <a href="fgpwd.html">password?</a></span>
    </div>
  </form>
</body>

</html>
