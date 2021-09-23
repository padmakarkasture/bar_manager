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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <link rel="stylesheet" href="css/warehouse.css">
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
               <table class="table">
    <thead>
      <tr>
        <!-- <th scope="col">#</th> -->
        <th scope="col">name</th>
        <th scope="col">category</th>
        <th scope="col">qauantity</th>
        <th scope="col">cp</th>
        <th scope="col">sp</th>
   

      </tr>
    </thead>
    <tbody>
      
      
  
                 <?php
                 include('connect.php');
                 $sql="select name, category, quantity, cp, sp from warehouse where ktransaction='catalog' order by name";
                 $q1=mysqli_query($con,$sql);
                 while($r=mysqli_fetch_array($q1)){
                   echo "<tr>
                   
                   <td>".$r['name']."</td>
                   <td>".$r['category']."</td>
                   <td>".$r['quantity']."</td>
                   <td>".$r['cp']."</td>
                   <td>".$r['sp']."</td>
                
                        </tr> 
                   
                   ";
                 }

                 ?>

               </div>
   </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>