<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageUserProfileController/manageUserProfileController.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageServiceController/manageServiceController.php';

$sp_ID = $_GET['sp_ID'];
$sp = new manageUserProfileController();
$data1 = $sp->viewSP($sp_ID);

$service = new manageServiceController();
$data = $service->viewService($sp_ID); 
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Home Page | Service Provider - Turbo Runner Delivery Service</title>
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
        <?php foreach($data1 as $sp) { ?>
          <a class="navbar-brand" href="#">Welcome to Turbo Runner Delivery System, <?=$sp['sp_name']?></a>
        <?php } ?>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../manageServiceView/addService.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-briefcase"></span> Add Product</a></li>
        <li><a href="../manageUserProfileView/spProfile.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/spAnalytic.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-screenshot"></span> Analytic</a></li>
        <li><a href="../manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <?php foreach ($data as $row) { ?>
    <div class="clearfix card">
      <a href="../manageServiceView/viewServiceDetails.php?service_ID=<?=$row['service_ID']?>">
        <img class="card-img-top" src="<?=$row['product_image']?>" alt="" height="230" width="230">
      </a>
      <div class="card-body">
        <h4 class="card-title"><?=$row['product_name']?></h4>
        <p class="card-text">RM<?=$row['product_unit_price']?></p>
      </div>
    </div>
  <?php } ?>
  </body>
</html>
