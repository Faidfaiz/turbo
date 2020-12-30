<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageUserProfileController/manageUserProfileController.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageTrackingAndAnalyticController/manageTrackingAndAnalyticController.php';

$runner_ID = $_GET['runner_ID'];
$rn = new manageUserProfileController();
$data = $rn->viewRunner($runner_ID);
$tracking = new manageTrackingAndAnalyticController();
$data1 = $tracking->viewUnacceptedTask();
$data2 = $tracking->viewAcceptedTask();

if (isset($_POST['accept'])) {
    $tracking->acceptTask();
}

if (isset($_POST['reject'])) {
    $tracking->rejectTask();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Home Page | Runner - Turbo Runner Delivery Service</title>
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
        <?php foreach($data as $rn) { ?>
          <a class="navbar-brand" href="#">Welcome to Turbo Runner Delivery System, <?=$rn['runner_name']?></a>
        <?php } ?>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../manageUserProfileView/runnerProfile.php?runner_ID=<?=$_SESSION['runner_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/runnerAnalytic.php?runner_ID=<?=$_SESSION['runner_ID']?>"><span class="glyphicon glyphicon-screenshot"></span> Analytic</a></li>
        <li><a href="../manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h2>Unaccepted Task List</h2>
        <table class="table table-bordered" align="center">
          <tr>
            <th>Tracking No</th>
            <th>Shipping Address</th>
            <th>Customer Phone Number</th>
            <th>Action</th>
          </tr>
          <tr>
          <?php
            $i = 1;
            foreach ($data1 as $row1) { ?>
          <form action="" method="POST">
          <tr>
            <input type="hidden" name="tracking_ID" value="<?=$row1['tracking_ID']?>">
            <td><?= $i ?></td>
            <td><?=$row1['shipping_address']?></td>
            <td><?=$row1['cust_phone']?></td>
            <td>
              <button type="submit" class="btn btn-success" name="accept">Accept</button>
            </td>
            <?php
              $i++;
            }
            ?>
          </tr>
        </form>
      </table>
  </div>

   <div class="container">
    <h2>Accepted Task List</h2>
      <form action="" method="POST">
        <table class="table table-bordered" align="center">
          <tr>
            <th>Tracking No</th>
            <th>Shipping Address</th>
            <th>Customer Phone Number</th>
            <th>Action</th>
          </tr>
          <tr>
          <?php
            $i = 1;
            foreach ($data2 as $row2) { ?>
          <tr>
            <td><?= $i ?></td>
            <td><?=$row2['shipping_address']?></td>
            <td><?=$row2['cust_phone']?></td>
            <td>
              <input type="hidden" name="tracking_ID" value="<?= $row2['tracking_ID'] ?>">
              <button type="button" class="btn btn-warning" onclick="location.href='../manageTrackingAndAnalyticView/updateTrackStatus.php?tracking_ID=<?= $row2['tracking_ID'] ?>'">Update</button>
              <button type="submit" class="btn btn-danger" name="reject">Reject</button>
            </td>
          <?php
            $i++;
            }
          ?>
          </tr>
        </table>
      </form>
  </div>
  </body>
</html>
