<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageTrackingAndAnalyticController/manageTrackingAndAnalyticController.php';

session_start();

$tracking = new manageTrackingAndAnalyticController();
$data1 = $tracking->viewTrackingList();
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Track Order | Customer - Turbo Runner Delivery Service</title>
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
      <ul class="nav navbar-nav">
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Home
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../manageOrderView/custHomePage.php?cust_ID=<?=$_SESSION['cust_ID']?>">Home</a></li>
          <li><a href="../manageOrderView/custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Food">Food</a></li>
          <li><a href="../manageOrderView/custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Goods">Goods</a></li>
          <li><a href="../custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Pet">Pet Assist</a></li>
          <li><a href="../manageOrderView/custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Medical">Medical</a></li>
        </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../manageOrderView/cart.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</a></li>
        <li><a href="../manageUserProfileView/custProfile.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/custTrack.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-map-marker"></span> Track</a></li>
        <li><a href="../manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h3>TrackingList</h3>
    <hr>
    <h1 align="center">On Delivery Order</h1>
      <table class="table table-bordered">
        <tr>
          <th>No</th>
          <th>Product Name</th>
          <th>Action</th>
        </tr>
        <?php
          $i = 1;
          foreach ($data1 as $row1) { ?>
          <form method="POST">
            <tr>
              <td><?= $i ?></td>
              <td><?= $row1['product_name'] ?></td>
              <td><button type="button" class="btn btn-info" onclick="location.href='../manageTrackingAndAnalyticView/custTrackStatus.php?tracking_ID=<?= $row1['tracking_ID'] ?>'">Status</button>
              </td>
            </tr>
          </form>
          <?php
            $i++;;
          }
          ?>
        </table>
      <button type="button" class="btn btn-danger" onclick="location.href='../manageOrderView/custHomePage.php?cust_ID=<?=$_SESSION['cust_ID']?>'">Back</button>
    </div>
  </body>
</html>
