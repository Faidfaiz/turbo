<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageTrackingAndAnalyticController/manageTrackingAndAnalyticController.php';
date_default_timezone_set('Asia/Kuala_Lumpur');

session_start();
$status = new manageTrackingAndAnalyticController();
$tracking_ID = $_GET['tracking_ID'];

if (isset($_POST['received'])) {
    $status->updateDeliveryStatus();
}
$data = $status->viewProgress($tracking_ID);
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Track Order Status | Customer - Turbo Runner Delivery Service</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
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
          <li><a href="../manageOrderView/custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Pet">Pet Assist</a></li>
          <li><a href="../manageOrderView/custProductList.php?cust_ID=<?=$_SESSION['cust_ID']?>&&product_category=Medical">Medical</a></li>
        </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../manageOrderView/cart.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</a></li>
        <li><a href="..manageUserProfileView/custProfile.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/custTrack.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-map-marker"></span> Track</a></li>
        <li><a href="../manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

    <div class="container">
      <h3>Track Status</h3>
        <hr>
        <table class="table table-bordered">
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Process</th>
            </tr>

            <tr>
              <?php
              $i = 1;
              foreach ($data as $row) { ?>
              <tr>
                <td><?=$row['tracking_date'] ?></td>
                <td><?=$row['tracking_time'] ?></td>
                <td><?=$row['tracking_progress'] ?></td>
              <?php
                $i++;
                }
              ?>
            </tr>
        </table>
        <form method="POST">
          <button type="button" class="btn btn-danger" onclick="location.href='custTrack.php?cust_ID=<?=$_SESSION['cust_ID']?>'">Back</button>
          <button type="submit" class="btn btn-warning" name="received" value="<?= $tracking_ID ?>">Confirm Received</button>
        </form>
    </div>
  </body>
</html>
