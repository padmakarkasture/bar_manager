<?php
session_start();
if($_SESSION['user_name']){ 
 
}else{
  header("Location:index.php");
}

include('connect.php');
        $sql1="select * from counter where quantity > 0 and name not in(select name from temp)";
 
          $q1=mysqli_query($con, $sql1); 
          
        if(mysqli_num_rows($q1)>0){
          ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style> 

    </style>
    <meta charset="UTF-8">
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main calculation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="css/warehouse.css">
</head>
<body>
    <main>
<div class="top">
    <h4 class="pt-3 pl-3 ">counter calculation</h4> 
<p class=" pl-3 "></p>

<button onclick="location.href='dashboard.php';" class="btn   shadow-lg"> <svg width="2.5em" height="4em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
  <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
</svg></button>
</div>

<div class="container"> 
   
                         
        <?php
     
        
          while($r = mysqli_fetch_array($q1))
           {
              echo "   <form class='form-inline' action='mainsubmit.php' method='POST'>
                <div class='form-group mb-2'>
                  <label  class='formitem'>".$r['name']."   ".$r['category']."</label>
                  <input type='hidden' name='name' value='".$r['name']."'>
                  <input type='number' name='remaining' step='0.1' max='".$r['quantity']."'  class='form-control formitem' placeholder=' remaining bottles ".$r['quantity']."' required>
                  <input type='hidden' name='quantity' value='".$r['quantity']."'>
                  <input type='hidden' name='category' value='".$r['category']."'>
                  <input type='hidden' name='sp' value='".$r['sp']."'>
                  <input type='hidden' name='pk' value='".$r['productkey']."'>
                  
                  <input type='submit' name='submit' class='btn btn-light formitem mt-3'>
                </div>
               
             </form>  <br>";
            }
          }else{
          header("Location:cmain.php");
          }
    
            
        
        
        
            ?>
             
             
            
    </main>
 
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>