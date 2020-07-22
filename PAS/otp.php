<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pas";
session_start();
$uname=$_SESSION["sisuname"];
$otp=$_POST["otp"];
// echo "length=" strlen($uname);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM otp where name='$uname'".";";
$result = mysqli_query($conn, $sql);
    // output data of each row
$row = mysqli_fetch_assoc($result);
          if($uname==$row["name"] and $otp==$row["otp"])
          {
            session_start();
            $_SESSION["sisuname"] = $uname;
            header('Location:resetpwd.html');

          }
          else {
            // echo($otp);
            header('Location:otp_error.html');
          }
mysqli_close($conn);
?>
