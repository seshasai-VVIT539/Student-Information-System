<?php
session_start();
$_SESSION["Rollnumber"] = "501";
$_SESSION["Name"] = "Abdul";
echo 'The Name of the student is :' . $_SESSION["Name"] . '<br>';
echo 'The Roll number of the student is :' . $_SESSION["Rollnumber"] . '<br>';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample";
$stdid='17BQ1A0501';
$br='cse';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1="show columns from marks;";
$files=array();
$size=0;
$result1=mysqli_query($conn,$sql1);
while($r=mysqli_fetch_array($result1))
{
  $files[]=$r['Field'];
  echo($files[$size]);
  $size=$size+1;
}
$sql = "SELECT * FROM marks where htno='$stdid'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="180" width="130"/ alt="image not found">';
$s=0;
sort($files);
echo("<br>");
$a=['','a','b','c'];
echo($a[1]);
$sem=0;
while ($sem<8) {
  $yr=(int)($sem/2)+1;
  echo("<br>year");
  echo($yr);
  echo("<br>");
  for($i=1;$i<3;$i++)
  {
    echo("<br>sem ");
    echo($sem+1);
    echo("<br>");
    while (true) {
      if(substr($files[$s],0,1)!=$yr)
      { echo($files[$s]);
        // echo("<br>");
        break;}
      else {
        $sql2="select * from demo where branch='$br' and sub_id='$files[$s]'";
        $result2=mysqli_query($conn,$sql2);
        $subjects=$result2->fetch_array(MYSQLI_ASSOC);
        if($subjects!=NULL)
        {
          echo($subjects['sub_name']);
          echo($row[$files[$s]]);
          echo("<br>");
        }
      }
        $s=$s+1;
    }
    $sem=$sem+1;
  }

}
if(isset($_SESSION["Name"])){
    unset($_SESSION["Rollnumber"]);
}
echo 'The Name of the student is :' . $_SESSION["Name"] . '<br>';
echo 'The Roll number of the student is :' . $_SESSION["Rollnumber"] . '<br>';

  mysqli_close($conn);
 ?>
