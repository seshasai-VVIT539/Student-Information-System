<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pas";
$uname=$_POST["uname"];
$pwd=$_POST["psw"];

// echo "length=" strlen($uname);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM users where name='$uname' and password='$pwd' ".";";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)==1)
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result))

    {
          if($uname==$row["name"] and $pwd==$row["password"])
          {
            session_start();
            $_SESSION["sisuname"] = $uname;
            $_SESSION["sispwd"] = $pwd;
            $_SESSION["last_activity"]=time();
            header('Location:home.html');
            break;
          } 
          else {
            header('Location:inder_error.php');
          }
    }

} else {
         header('Location:index_error.php');
}

mysqli_close($conn);
?>
