
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
    <title>cmain</title>
  </head>
  <body >
  <div class="top">
    <h4 class="pt-3 pl-3 ">counter calculation</h4> 
      <p class=" pl-3 "></p>
  </div>
  <main>
    <div class="container " >
    <div style="overflow-x:auto;">
    <table class="table ">
    <thead>
      <tr>
        <!-- <th scope="col">#</th> -->
        <th scope="col">name</th>
        <th scope="col">category</th>
        <th scope="col">sales</th>
        <th scope="col">sp</th>
        <th scope="col">total price</th>

      </tr>
    </thead>
    <tbody>
      <tr>
      
  
  
 
      <?php
      include('connect.php');
      $sql1="SELECT  warehouse.sp, temp.name, temp.sales, temp.category
      FROM warehouse
     right JOIN temp ON warehouse.name = temp.name and warehouse.category=temp.category where warehouse.ktransaction='catalog' and warehouse.category=temp.category";
    
      $q1=mysqli_query($con,$sql1);
      $sum=0;
      if(mysqli_num_rows($q1)>0){

      while($r= mysqli_fetch_array($q1)){
        $total=$r['sales'] * $r['sp'];
       echo" 
       <tr><td>".$r['name']."</td>
       <td>".$r['category']."</td>
        <td>".$r['sales']."</td>
        <td>".$r['sp']."</td>
        <td>".$total."</td>
</tr>
        
        
        ";
        $sum=$sum+ $total;
       
      }
      echo "<tr><td></td>
      <td></td>
      <td></td>

      <th class='formitem '>Total = </th>
      <td class='formitem'>".$sum." </td>
      </tr>";
      

      ?>
      <tr><td>
      <button onclick="location.href='cancelled.php';" class="btn-grad">
        cancel
      </button>
      </td>
      <td><form action="confirmed.php" method="POST"> <div class="form-group ">
        <input type="date" name="date" class="form-control mt-3 text-center shadow  formitem" id="exampleInputPassword1" placeholder="date" required>
      </div></td>
      <td></td>

      <th class='formitem '> </th>
      <td class='formitem'><input type="hidden" name="total" value="<?php echo $sum; ?>"> <input type="submit" class="btn-grad" value='confirm'> </form> 
      </button></td>
      </tr>
   
        </tbody>
        </table>
    </div>
        <?php
      }
      else{
        header("Location:dashboard.php");
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