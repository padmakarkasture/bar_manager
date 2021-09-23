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
   <!-- animate -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />
    <!-- Bootstrap CSS -->
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/warehouse.css">
    <title>dashboard</title>
  </head>
  <body>
  <main class="dashboard">
       <div class="top ">
<h4 class="pt-3 pl-3 ">Hotel Suraj</h4> 
<p class=" pl-3 ">Dashboard</p>
 <button onclick="location.href='logout.php';" class="btn   shadow-lg"> 
<svg width="1.5em" height="3em" viewBox="0 0 16 16" class="bi bi-box-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg>
</svg></button> 
</div>
<div class="container">

<div class="row">
  <div class="col-xs-6">
    <button onclick="location.href='warehouse.php';"  class="btn-grad animate__animated animate__fadeIn  shadow">warehouse</button>
    <button onclick="location.href='main.php';"  class="btn-grad animate__animated animate__fadeIn shadow">hishob</button>
  </div>
  <div class="col-xs-6">
    <button onclick="location.href='modification.php';"  class="btn-grad animate__animated animate__fadeIn ">modification</button>
    <button  onclick="location.href='stock.php';" class="btn-grad shadow animate__animated animate__fadeIn ">stock</button>
  </div>
</div>




</div>

<div class="chart mt-3">
  <div class="container">
  <canvas id="myChart" width="400" height="400"></canvas>
  </div>
</div>

<div class="container mt-3 ">
<form action="stats.php" method="POST">
<div class="form-group mt-5">
 <input type="date" name="date"  class="form-control input-sm text-center shadow  formitem" id="exampleInputPassword1" placeholder="quantity" required>
 </div>
 <div class="form-group  ml-4 ">
 <input type="submit" name="" value="get statistics"  class=" btn-grad ml-5" id="exampleInputPassword1" placeholder="quantity" required>
 </div>
</form>
</div>
</main>
<script>
  <?php 
   include('connect.php');
   $sql1="select sp, date from report where rtransaction='dailyreport'";
   $q1=mysqli_query($con,$sql1);
  ?>
  
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
        <?php  while($r=mysqli_fetch_array($q1)){
             echo "'".$r['date']."',";

            }?>
        
        ],
        datasets: [{
            label: '# of income',
            data: [
            <?php
             $sql1="select sp, date from report where rtransaction='dailyreport'";
             $q1=mysqli_query($con,$sql1);
            while($r=mysqli_fetch_array($q1)){
             echo $r['sp'].",";

            }
            ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>



