<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageUserProfileController/manageUserProfileController.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageOrderController/manageOrderController.php';

$cust_ID = $_SESSION['cust_ID'];
$cust = new manageUserProfileController();
$data1 = $cust->viewCust($cust_ID);
$service = new manageOrderController();
$data = $service->viewProduct(); 

if (isset($_POST['submit'])) {
  if(!(is_null($_POST['search']))){
  $search = $_POST['search'];
  $data = $service->searchProduct($search);
  }
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Home Page | Customer - Turbo Runner Delivery Service</title>
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
        <?php foreach($data1 as $cust) { ?>
          <a class="navbar-brand" href="#">Welcome to Turbo Runner Delivery System, <?=$cust['cust_name']?></a>
        <?php } ?>
      </div>
      <ul class="nav navbar-nav">
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Home
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../manageOrderView/custHomePage.php?cust_ID=<?=$_SESSION['cust_ID']?>">Home</a></li>
          <li><a href="../manageOrderView/custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Food">Food</a></li>
          <li><a href="../manageOrderView/custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Goods">Goods</a></li>
          <li><a href="../manageOrderView/custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Pet">Pet Assist</a></li>
          <li><a href="../manageOrderView/custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Medical">Medical</a></li>
        </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" name="search" placeholder="Search Product...">
        </div>
        <button type="submit" name="submit" class="btn btn-default">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../manageOrderView/cart.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</a></li>
        <li><a href="../manageUserProfileView/custProfile.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/custTrack.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-map-marker"></span> Track</a></li>
        <li><a href="../manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <?php foreach ($data as $row) { ?>
    <div class="clearfix card">
      <a href="../manageOrderView/viewProductDetails.php?service_ID=<?=$row['service_ID']?>">
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
