<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pas";
$uname=$_POST["userid"];
// $pwd=$_POST["psw"];
// echo "length=" strlen($uname);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM users where name='$uname'".";";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)==1)
{
    // $row = $result->fetch_array(MYSQLI_ASSOC);
    $sql1="delete from otp where name='$uname';";
    $result1 = mysqli_query($conn, $sql1);
    $otp=rand(1000,9999);
    $sql1="insert into otp values('$uname','$otp');";
    $result1 = mysqli_query($conn, $sql1);
    $to=$uname;
    $subject='Student Information System';
    $msg="Your otp is '$otp'";
    $mailer=mail($to,$subject,$msg);
    // output data of each row
    session_start();
    $_SESSION["sisuname"]=$uname;
        // $sql1="UPDATE users SET password = '$npwd1' where name='$uname' and password='$cpwd'";
        // $result1=mysqli_query($conn,$sql1);
        // echo("done");
        $sql1="delete from otp where name='$uname';";
        $result1 = mysqli_query($conn, $sql1);
        $otp=rand(1000,9999);
        $sql1="insert into otp values('$uname','$otp');";
        $result1 = mysqli_query($conn, $sql1);
        header('Location:otp.html');
}
else {
  $message = "wrong answer";
echo "<script type='text/javascript'>alert('$message');</script>";
  header('Location:fgpwd_error.html');
}
mysqli_close($conn);
 ?>
