<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageTrackingAndAnalyticController/manageTrackingAndAnalyticController.php';

session_start();
$sp_ID = $_GET['sp_ID'];

$tracking = new manageTrackingAndAnalyticController();
$data = $tracking->viewSales($sp_ID); 

$earning = 0;
$total = 0;
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Analytic | Service Provider - Turbo Runner Delivery Service</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <style type="text/css">
      .card {
        height: 280px;
        width: 20%;
        margin-left: 20px;
        margin-right: 20px;
        margin-bottom: 30px;
        float: left;
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Welcome to Turbo Runner Delivery System</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../manageServiceView/addService.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-briefcase"></span> Add Product</a></li>
        <li><a href="../manageUserProfileView/spProfile.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/spAnalytic.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-screenshot"></span> Analytic</a></li>
        <li><a href="../manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h3>Sales Report</h3>
    <table class="table table-bordered">
      <tr>
        <th>Product Name</th>
        <th>Earning</th>
      </tr>
      <?php foreach ($data as $row) {
        $earning = $row['quantity']*$row['product_unit_price'];
        $total += $earning; 
      ?>
      <tr>
        <td><?=$row['product_name'] ?></td>
        <td><?=$earning ?></td>
      </tr>
      <?php } ?>  
      <tr>
        <td><strong>Total Earning: </strong></td>
        <td><?=$total ?></td>
      </tr>
    </table>
    <button type="button" class="btn btn-danger" onclick="location.href='../../ApplicationLayer/manageServiceView/spHomePage.php?sp_ID=<?=$_SESSION['sp_ID']?>'">Back</button>
  </div>
  </body>
</html>
