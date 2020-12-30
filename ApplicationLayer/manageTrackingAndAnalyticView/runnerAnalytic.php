<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageTrackingAndAnalyticController/manageTrackingAndAnalyticController.php';

session_start();
$runner_ID = $_GET['runner_ID'];

$tracking = new manageTrackingAndAnalyticController();
$data = $tracking->viewDelivery($runner_ID); 

$delivery = 0;
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Analytic | Runner - Turbo Runner Delivery Service</title>
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
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../manageUserProfileView/runnerProfile.php?runner_ID=<?=$_SESSION['runner_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/runnerAnalytic.php?runner_ID=<?=$_SESSION['runner_ID']?>"><span class="glyphicon glyphicon-screenshot"></span> Analytic</a></li>
        <li><a href="../manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h2>Total Delivery Order</h2>
      <table class="table table-hover">
        <tr>
          <th>No</th>
          <th>Tracking ID</th>
          <th>Shipping Address</th>
        <tr>
          <tr>
          <?php
            $i = 1;
            foreach ($data as $row) { ?>
          <tr>
            <td><?= $i ?></td>
            <td><?=$row['tracking_ID']?></td>
            <td><?=$row['shipping_address']?></td>
          <?php
            $delivery = $row['count'];
            $i++;
            }
          ?>
          </tr>
          <tr>
            <td colspan="2">Total Delivery:</td>
            <td><?=$delivery?></td>
          <tr>
      </table>
      <button type="button" class="btn btn-danger" onclick="location.href='../manageTrackingAndAnalyticView/runnerHomePage.php?runner_ID=<?=$_SESSION['runner_ID']?>'">Back</button>
  </div>
  </body>
</html>
