<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Student Information System</title>
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <style media="screen">
    #asdf{
      width:80%;
      justify-content:space-around;
      margin-left: 20%;

    }
    /* body
    {
      height:297mm;
    width:210mm;
    } */
    form{
      width: 30%;
      margin-left: 20%;
    }
    th,td{
      text-align: left;
      wrap:
    }
    .stdimg{
      width: 10%;
      height: 10%;
      padding-left: 0px;
    }
    .contain{
      width: 100%;
      /* margin-left: 25%; */
      justify-content: space-between;
      display: flex;
    }
    .outercontainer{
      /* width: 90%; */
      display: flex;
      justify-content: space-between;
    }
     .leftcontainer{
      width:50%;
      display: flex;
      margin-top: 2%;
      /* float: left; */
    }
    .rightcontainer{
      width: 100%;
      display: flex;
      margin-top: 2%;
      /* float: right; */
   }
    .tablecontainer{
      /* width: 90%; */
      margin-left: 10%;
    }
    .details{
      width: 50%;
      margin-left: 20%;
    }
    button{
      padding: 14px 0px;
    }
    /* body {visibility:hidden;}.print {visibility:visible;} */
    .print{
      width: 60px;
      margin-left: 45%;
    }
    /* @page print-content{

    size: 21cm 29.7cm;
    margin: 30mm 45mm 30mm 45mm;
     /* change the margins as you want them to be. */
} */
    @media print {
      body{
        width: 90%;
      }
      table{
        width: 100%;
      }
      .outercontainer{
        width: 50%;
        display: flex;
      }
      th{
        white-space: nowrap;
      }
       .leftcontainer{
        width: 50%;
        float: left;
        /* display: flex; */
        margin-top: 2%;
      }
      .rightcontainer{
       width: 50%;
       float: right;
       /* display: flex; */
       margin-top: 2%;
     }
    }
  </style>
</head>
<?php
session_start();
if(time()-$_SESSION["last_activity"]>1800)
{
  session_destroy();
    session_unset();
}
if(isset($_SESSION["sisuname"]) and isset($_SESSION["sispwd"])) {
//     unset($_SESSION["Rollnumber"]);
$stdid= $_GET['stdID'];
$dbname=0;
if(strlen($stdid)!=10)
{
  header('Location:home_error.html');
}
// if(substr($stdid,2,2)!="BQ" and substr($stdid,2,2)!="bq")
// {
//     header('Location:home_error.html');
// }
if(substr($stdid,4,2)=='5A' or substr($stdid,4,2)=='5a')
{
  $dbname=(int)substr($stdid,0,2)-1;
}
else if(substr($stdid,4,2)=='1A' or substr($stdid,4,2)=='1a')
{
  $dbname=(int)substr($stdid,0,2);
}
else {
  header('Location:home_error.html');
}
if($dbname%3==0)
{
  $dbname='r'.(string)($dbname-2);
}
else {
  $dbname='r'.(string)($dbname-($dbname%3)+1);
}
$servername = "localhost";
$username = "root";
$password = "";
// $dbname = "r16";

$branch=substr($stdid,6,2);
$br=$branch;
if($branch==1)
{
  $branch="Civil Engineering";
  $br="ce";
}
elseif($branch==2)
{
  $branch="Electrical and Electronics Engineering";
  $br="eee";
}
elseif($branch==3)
{
  $branch="Mechanical Engineering";
  $br="me";
}
elseif($branch==4)
{
  $branch="Electronics and Communication Engineering";
  $br='ece';
}
elseif($branch==5)
{
  $branch="Computer Science and Engineering";
  $br="cse";
}
elseif($branch==12)
{
  $branch="Information Technology";
  $br="it";
}
else {
  header('Location:home_error.html');
}
if (!mysqli_connect($servername, $username, $password, $dbname)) {
  // code...
  header('Location:home_error.html');
}
try {
  $conn = mysqli_connect($servername, $username, $password, $dbname);
} catch (Exception $e) {
  header('Location:home_error.html');
}


//Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    header('Location:home_error.html');
}
?>

<body>
  <header class="header">
    <h1>Student Information System</h1>
  </header>
  <div class="contain">
    <form action="home.php">
        <input type="text" placeholder="Enter Student ID" name="stdID" value="<?php echo($stdid) ?>" required>
        <button type="submit">Get Details</button>
    </form>
    <?php
    try {
    $sql1="show columns from marks;";
    $files=array();
    $size=0;
    $year=['','YEAR I','YEAR II','YEAR III','YEAR IV'];
    $result1=mysqli_query($conn,$sql1);
    while($r=mysqli_fetch_array($result1))
    {
      $files[]=$r['Field'];
      $size=$size+1;
    }
    $sql = "SELECT * FROM marks where htno='$stdid'";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['name']==NULL) {
      header('Location:home_error.html');
    }
    // echo '<img src="data:image/jpeg;base64'.base64_encode($row['img'] ).'" height="180" width="130"/ alt="image not found">';
    echo '<img class="stdimg" src="' . $row['img'] . '.jpg" / alt="image not found">';
     ?>
       <div>

         <button  onclick="window.location.href='/PAS/logout.php'">Logout</button>

         <a href='chngpwd.html'><button>change password</button></a>
       </div>
   </div>
   <div id="print-content">
   <div class="details">
     <p><b>Name&nbsp&nbsp&nbsp&nbsp&nbsp:</b> &nbsp &nbsp &nbsp <?php echo($row['name']); ?></p>
     <p><b>Roll No &nbsp:</b>&nbsp &nbsp &nbsp <?php echo($row['htno']); ?></p>
     <p><b>Branch&nbsp&nbsp:</b>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo("\t"); echo($branch); ?></p>
     <!-- <h4><b>Section&nbsp&nbsp:</b></h4> -->
   </div>



   <div class="tablecontainer">
     <table style="border:1px white;width:100%;">
     <?php
        $sem=0;
        $s=0;
        sort($files);

        while($sem<8)
        {
          $yr=(int)($sem/2)+1;
      ?>

        <tr>
          <td style="width:20%;border:1px white;">

      <div class="outercontainer">
        <h3><?php echo($year[$yr]); ?></h3>
        <?php

        ?>
        </td>
        <td style="width:50%;border:1px white;">
        <div class="leftcontainer">
              <table id="asdf" width='50%'>
                  <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Grade</th>
                    </tr>
                  </thead>
                    <?php
                    $flag=false;
              while(true)
              {
                if(substr($files[$s],0,1)!=$sem+1)
                {
                  if ($flag==false) {
                    ?>
                    <tr>
                      <th>NIL</th>
                      <th>NIL</th>
                    </tr>
                    <?php
                  }
                  break;}
                else {
                  $flag=true;
                  $sql2="select * from sub where branch='$br' and sub_id='$files[$s]'";
                  $result2=mysqli_query($conn,$sql2);
                  $subjects=$result2->fetch_array(MYSQLI_ASSOC);
                  if($subjects!=NULL)
                  {
                    ?>
                    <tr>
                      <td> <?php echo($subjects['sub_name']); ?> </td>
                      <td><?php if(!is_null($row[$files[$s]])) {echo($row[$files[$s]]); }
                        else{
                          echo("NIL");
                        }?></td>
                      </tr>
                      <?php
                  }
                }
        $s=$s+1;}
          $sem=$sem+1;
          // echo("<br><br> \n");
          ?>
          </table>
        </div>
        </td>
        <td style="width:50%;border:1px white;">
        <div class="rightcontainer">
              <table id="asdf" style="margin-right:50px;">
                  <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Grade</th>
                    </tr>
                  </thead>
                    <?php
                    $flag=false;
              while(true)
              {
                if(substr($files[$s],0,1)!=$sem+1)
                {
                  if ($flag==false) {
                    ?>
                    <tr>
                      <th>NIL</th>
                      <th>NIL</th>
                    </tr>
                    <?php
                  }
                  break;}
                else {
                  $flag=true;
                  $sql2="select * from sub where branch='$br' and sub_id='$files[$s]'";
                  $result2=mysqli_query($conn,$sql2);
                  $subjects=$result2->fetch_array(MYSQLI_ASSOC);
                  if($subjects!=NULL)
                  {
                    ?>
                    <tr>
                      <td> <?php echo($subjects['sub_name']); ?> </td>
                      <td><?php if(!is_null($row[$files[$s]])) {echo($row[$files[$s]]); }
                        else{
                          echo("NIL");
                        }?></td>
                      </tr>
                      <?php
                  }
                }
        $s=$s+1;}
          $sem=$sem+1;
          // echo("<br><br> \n");
          ?>
          </table>
        </div>
        </td>
          <?php

      // echo("<br>\n\n");
      ?>
    </div>
      <?php
    }

          mysqli_close($conn);
        } catch (Exception $e) {
            header('Location:home_error.html');
        }
        // mysqli_close($conn);
        }
          else{
            header('Location:index.html');
          }
         ?>

        <br>
        <br>
      </tr>
    </table>
      </div>

    </div>
      <button class='print' onclick="printDiv()" value="Print">Print</button>
</body>
<script type="text/javascript">
    function printDiv() {
        var printContents = document.getElementById("print-content").innerHTML;
        w=window.open();
        w.document.write(printContents);
        w.print();
        w.close();
    }
</script>
</html>
