<?php
session_start();
if($_SESSION['user_name']){ 
 
}else{
  header("Location:index.php");
}

include('connect.php');
$date=$_POST['date'];
$sum=$_POST['total'];

$sql1="update temp set date ='$date'";
$q1=mysqli_query($con, $sql1);
$sql2="select productkey,remaining from temp";
$q2=mysqli_query($con, $sql2);
while($r=mysqli_fetch_array($q2)){
    $pk=$r['productkey'];
    $re=$r['remaining'];
    $sql6="update counter set quantity='$re' where productkey='$pk'";
    $q6=mysqli_query($con,$sql6);
}


    $sql3="Insert into report
    (productkey,name, category, sales, sp, date)
    Select productkey, name, category, sales, sp, date  from temp";
    $q3=mysqli_query($con, $sql3);
    $sql4="DELETE FROM temp";
    $q4=mysqli_query($con, $sql4);

    $sql5="INSERT INTO `report`(`productkey`, `name`, `category`, `sales`, `sp`, `date`, `rtransaction`) VALUES ('dailyreport','default','default','default','$sum','$date','dailyreport')";
  
    $q5=mysqli_query($con, $sql5);
     header("Location:dashboard.php");


?>