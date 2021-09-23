
<?php
session_start();
if($_SESSION['user_name']){ 
 
}else{
  header("Location:index.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/warehouse.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <title>Hello, world!</title>
  </head>
  <body>
   <main>
    <div class="top">
        <h4 class="pt-3 pl-3 ">WAREHOUSE</h4> 
        <p class=" pl-3 ">entry</p>
        
        <button onclick="location.href='dashboard.php';" class="btn   shadow-lg"> <svg width="2.5em" height="4em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
          <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
        </svg></button>
               </div>
<div class="container">
               <?php
               include('connect.php');
               $date=$_POST['date'];
               echo $date;
               $sql="select * from report where date='$date' and rtransaction='normal'";
               $q=mysqli_query($con,$sql);
               if(mysqli_num_rows($q)>0){
                   echo"
                   <div style='overflow-x:auto;'>
                   <table class='table'>
                   <thead>
                     <tr>
                      
                       <th scope='col'>name</th>
                       <th scope='col'>category</th>
                       <th scope='col'>sales</th>
                       <th scope='col'>sp</th>
                       <th scope='col'>total price</th>
               
                     </tr>
                   </thead>
                   <tbody>
                     
                     
                 
                   ";
                   $sum=0;
                   while($r=mysqli_fetch_array($q)){
                       $total=$r['sp']*$r['sales'];
                       $sum=$sum+$total;
                       echo" 
                       <tr><td>".$r['name']."</td>
                       <td>".$r['category']."</td>
                        <td>".$r['sales']."</td>
                        <td>".$r['sp']."</td>
                        <td>".$total."</td>
                </tr>
                        
                        
                        ";
                   }



               }else{
                   echo"<h3> No records Found</h3>";
               }

               ?>
               <tr>
               <td></td>
               <td></td>
               <td></td>
               <td>Total</td>
               <td><?php echo $sum; ?></td>
               </tr>
               </tbody>
               </table>
            </div>


            </div>
               
   </main>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>