<?php
session_start();
if(isset($_SESSION["sisuname"]))
{
  // $cpwd=$_POST["cpwd"];
  $npwd1=$_POST["npwd1"];
  $npwd2=$_POST["npwd2"];
    if($npwd1 == $npwd2)
    {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "pas";
      $uname=$_SESSION["sisuname"];
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      // Check connection
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }
      $sql = "SELECT * FROM users where name='$uname' ".";";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result)==1)
      {
          $row = $result->fetch_array(MYSQLI_ASSOC);
          // output data of each row
          if($uname==$row["name"])
          {
              $sql1="UPDATE users SET password = '$npwd1' where name='$uname'";
              $result1=mysqli_query($conn,$sql1);
              echo("done");
              $_SESSION["sispwd"]=$npwd1;
              $sql1="delete from otp where name='$uname'";
              $result1=mysqli_query($conn,$sql1);
              header('Location:home.html');
          }
      }
      mysqli_close($conn);
      } else {
               header('Location:resetpwd_error.html');
      }
  }
  else {
    header('Location:index.html');
  }
 ?>
