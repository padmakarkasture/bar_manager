
         <?php
session_start();
if($_SESSION['user_name']){ 
 
}else{
  header("Location:index.php");
}

         include('connect.php');
         $name=$_POST['name'];
             $sp=$_POST['sp']; 
             $category=$_POST['category'];
             $pk=$_POST['pk'];
             $quantity=$_POST['quantity'];
     
             $remaining=$_POST['remaining'];
         
             $int =floatval($quantity);
             
             $total=$int-$remaining;
        
             $sql2="INSERT INTO `temp`(`productkey`, `name`, `category`, `sales`, `sp`, `remaining`) VALUES ('$pk', '$name', '$category', '$total', '$sp', '$remaining')";
             $q2=mysqli_query($con,$sql2);  
             header("Location: main.php");
             ?>