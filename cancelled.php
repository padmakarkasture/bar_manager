<?php
session_start();
if($_SESSION['user_name']){ 
 
}else{
  header("Location:index.php");
}

include('connect.php');
    $sql3="DELETE FROM temp";
    $q3=mysqli_query($con, $sql3);
    header("Location:dashboard.php");


?>