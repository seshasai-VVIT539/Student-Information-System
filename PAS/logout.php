<?php
session_start();
unset($_SESSION["sisuname"]);
unset($_SESSION["sispwd"]);
session_destroy();
header('Location:index.html');
 ?>
