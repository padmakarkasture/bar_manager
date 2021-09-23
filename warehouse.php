<?php 

session_start();
if($_SESSION['user_name']){ 
 
}else{
  header("Location:index.php");
}

  include('connect.php');
  include('pid.php');

  if(isset( $_POST['newc'])) {
$pn=$_POST['name'];

$cps90=$_POST['cp90'];
$cp90=floatval($cps90);
$sps90=$_POST['sp90'];
$sp90=floatval($sps90);


$cpsquarter=$_POST['cpquarter'];
$cpquarter=floatval($cpsquarter);
$spsquarter=$_POST['spquarter'];
$spquarter=floatval($spsquarter);


$cpshalf=$_POST['cphalf'];
$cphalf=floatval($cpshalf);
$spshalf=$_POST['sphalf'];
$sphalf=floatval($spshalf);



$cpsunit=$_POST['cpunit'];
$cpunit=floatval($cpsunit);
$spsunit=$_POST['spunit'];
$spunit=floatval($spsunit);


$date=$_POST['daten'];
$transaction='catalog';
$zer=0;
$de='temp';
$ninety='90';
$quarter='quarter';
$half='half';
$unit='unit';
$productid90 = derive($pn,$ninety); 
$productidquarter = derive($pn,$quarter);
$productidhalf = derive($pn,$half);
$productidunit =   derive($pn,$unit);
$sqlq1="INSERT INTO `warehouse`(`productkey`, `name`, `category`, `quantity`, `cp`, `sp`, `kdate`, `seller`, `ktransaction`) VALUES('$productid90', '$pn', '90', '$zer', '$cp90', '$sp90', '$date',' $de', '$transaction'),('$productidquarter', '$pn', 'quarter', '$zer', '$cpquarter', '$spquarter', '$date',' $de', '$transaction'),('$productidhalf', '$pn', 'half', '$zer', '$cphalf', '$sphalf', '$date',' $de', '$transaction'),('$productidunit', '$pn', 'unit', '$zer', '$cpunit', '$spunit', '$date',' $de', '$transaction')";
$sqlq0="INSERT INTO `counter`(`productkey`, `name`, `category`, `quantity`, `sp`, `kdate`) VALUES ('$productid90', '$pn', '90', '$zer', '$sp90', '$date'), ('$productidquarter', '$pn', 'quarter', '$zer', '$spquarter', '$date'), ('$productidhalf', '$pn', 'half', '$zer', '$sphalf',  '$date'), ('$productidunit', '$pn', 'unit', '$zer','$spunit', '$date')";

$q1=mysqli_query($con,$sqlq1);
$q0=mysqli_query($con,$sqlq0);

 header("Location: warehouse.php");
}
else if(isset( $_POST['existingc'])){
  $name=$_POST['dd'];
  $category=$_POST['ddcategory'];
  $quantity=$_POST['quantity'];
  $seller=$_POST['seller'];
  $date=$_POST['datee'];
  $sql2q1="INSERT INTO `warehouse`(`name`, `category`, `quantity`, `cp`, `sp`, `kdate`, `seller`, `ktransaction`) VALUES ('$name', '$category', '$quantity', 0, 0, '$date',' $seller', 'inhouse')";
mysqli_query($con,$sql2q1);
$sql2q2="select quantity from warehouse where ktransaction='catalog' and name='$name' and category='$category'";
$q2=mysqli_query($con,$sql2q2);
$row = mysqli_fetch_row($q2);
$add=$row[0];
$stock=$add+$quantity;

$sql2q3="UPDATE warehouse SET quantity='$stock' WHERE ktransaction='catalog' and name='$name' and category='$category' ";
$q3=mysqli_query($con, $sql2q3);
header("Location: warehouse.php");

  

}

if(isset( $_POST['counter']))
 {
  $pn=$_POST['ddc'];
  $category=$_POST['ddcategory'];
  $quantity=$_POST['quantityc'];
  $date=$_POST['datec'];

  
$sql3q2="select quantity from warehouse where ktransaction='catalog' and name='$pn' and category='$category'";
$q6=mysqli_query($con,$sql3q2);
$row = mysqli_fetch_row($q6);
$available=$row[0];
if($quantity > $available){
  $message="you have only ".$available." stock of ". $pn ." ( ". $category." )left in warehouse so insert value carefully";
  header("Location: message.php?link=" . $message . "");

}
else{
  $stock=$available - $quantity;
  $sql2q3="UPDATE warehouse SET quantity='$stock' WHERE ktransaction='catalog' and name='$pn' and category='$category'";
$q3=mysqli_query($con, $sql2q3);
$sql3q0 ="select quantity from counter where name='$pn' and category='$category'";
$q1=mysqli_query($con, $sql3q0);
$row = mysqli_fetch_row($q1);
$stock=$row[0];
$total=$stock + $quantity;
echo $total;

$sql3q1="UPDATE `counter` SET `quantity`='$total', `kdate`='$date' WHERE name='$pn' and category='$category'";
$q5=mysqli_query($con,$sql3q1);

header("Location: warehouse.php");

}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta http-equiv="refresh" content="5"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="css/warehouse.css">
    <title>warehouse</title>
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
       <div class="formDiv">
           
           <div class="container ">
           <div class="old">
            
            <form action="" method="POST">
           
                <div class="form">
                  <div class="text-center ">
                    <h4 class="heading-warehouse">warehouse entry</h4>
                  </div>
                 <div class="form-group ">
                 <div class="dropdown">
                    
                   <select name="dd" class="selectp dropdown-toggle formitem btn" id="inputGroupSelect04">
                        <option  class="option" selected>Choose...</option> 
                        <?php 
                        $sql3q1="select distinct name from warehouse where ktransaction='catalog'";
                        $q4=mysqli_query($con,$sql3q1);
                        while($r = mysqli_fetch_array($q4))
                        {
                         echo "<option  class='option' required>".$r['name']."</option>";

                            
                        }
                     
                         
                         ?> 
                         
                     </select>
                     <select name="ddcategory" class="selectp dropdown-toggle formitem btn" id="inputGroupSelect04">
                        <option  class="option" selected>Choose...</option> 
                       <option  class='option' required>90</option>
                       <option  class='option' required>quarter</option>
                       <option  class='option' required>half</option>
                       <option  class='option' required>unit</option>
                       
                     </select>
                   </div>
                   </div>
                  
                     <div class="form-group ">
                         
                         <input type="number" name="quantity" step="0.01" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="quantity" required>
                       </div>
                       
                       <div class="form-group ">
                         <input type="text" name="seller" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="seller info" required>
                       </div>
                       <div class="form-group ">
                         <input type="date" name="datee" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="date" required>
                       </div>
                       <div class="form-group ">
                         <input type="submit" name="existingc"  class="form-control text-center shadow  formitem" id="exampleInputPassword1" value="Do Entry">
                       </div>
                     </form>
           </div>
                    <div  class="new">
                    <form action="" method="POST">
                        <div class="form text-center">
                          <div class="text-center ">
                            <h4 class="heading-warehouse">New Catalog</h4>
                          </div>
                       
                             <div class="form-group ">
                                 
                                 <input type="text" step="1" name="name" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="product name" required>
                                 </div>
                                 <p class="formitem">90</p>
                                 <div class="form-group ">
                                 <input type="number" name="cp90" step="0.01" class="form-control text-center shadow formitem" id="exampleInputPassword1" placeholder="cost price" required>
                                 <input type="number" name="sp90" step="0.01" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="selling price" required>
                               
                               </div>
                               <p class="formitem">quarter</p>
                                 <div class="form-group ">
                                 <input type="number" name="cpquarter" step="0.01" class="form-control text-center shadow formitem" id="exampleInputPassword1" placeholder="cost price" required>
                                 <input type="number" name="spquarter" step="0.01" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="selling price" required>
                               
                               </div>
                               <p class="formitem">half</p>
                               <div class="form-group ">
                             
                                 <input type="number" name="cphalf" step="0.01" class="form-control text-center shadow formitem" id="exampleInputPassword1" placeholder="cost price" required>
                                 <input type="number" name="sphalf" step="0.01" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="selling price" required>
                               
                               </div>
                               <p class="formitem">unit</p>
                               <div class="form-group ">
                                 <input type="number" name="cpunit" step="0.01" class="form-control text-center shadow formitem" id="exampleInputPassword1" placeholder="cost price" required>
                                 <input type="number" name="spunit" step="0.01" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="selling price" required>
                               
                                 <p class="formitem">date</p>
                               <div class="form-group ">
                                 <input type="date" name="daten"  class="form-control text-center shadow  formitem " id="exampleInputPassword1" placeholder="date" required>
                               </div>
                               <div class="form-group ">
                                 <input type="submit" name="newc" class="form-control text-center shadow  formitem" id="exampleInputPassword1" value="add"  >
                               </div>
                             </form>
                            </div>
                            
                            </div>
                            <form action="" method="POST">
           
                              <div class="form  ">
                                <div class="text-center ">
                                  <h4 class="heading-warehouse">Counter</h4>
                                </div>
                               <div class="form-group ">
                               <div class="dropdown">
                                  
                                 <select name="ddc" class="selectp dropdown-toggle formitem btn" id="inputGroupSelect04">
                                      <option  class="option" selected>Choose...</option> 
                                      <?php 
                                      $sql3q1="select distinct name from warehouse where ktransaction='catalog'";
                                      $q4=mysqli_query($con,$sql3q1);
                                      while($r = mysqli_fetch_array($q4))
                                      {
                                       echo "<option  class='option' required>".$r['name']."</option>";
                                          
                                      }
                                   
                                       
                                       ?> 
                                       
                                   </select>
                                   <select name="ddcategory" class="selectp dropdown-toggle formitem btn" id="inputGroupSelect04">
                        <option  class="option" selected>Choose...</option> 
                       <option  class='option' required>90</option>
                       <option  class='option' required>quarter</option>
                       <option  class='option' required>half</option>
                       <option  class='option' required>unit</option>
                       
                     </select>

                                 </div>
                                 </div>
                                
                                   <div class="form-group ">
                                       
                                       <input type="number" name="quantityc" step="0.01" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="quantity" required>
                                     </div>
                                     
                                     <div class="form-group ">
                                       <input type="date" name="datec" class="form-control text-center shadow  formitem" id="exampleInputPassword1" placeholder="date" required>
                                     </div>
                                     <div class="form-group ">
                                       <input type="submit" name="counter"  class="form-control text-center shadow  formitem" id="exampleInputPassword1" value="To Counter ">
                                     </div>
                                   </form>
               </div>


               
               <!-- end of form -->
           </div>
           <!-- end of container -->


       </div>
       <!-- end of form div -->
   </main>
      
    
      <script type="text/javascript">
        var d = new Date();
  var n = d.toLocaleDateString();
  document.getElementById('date').value = n;
</script>
   
   

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