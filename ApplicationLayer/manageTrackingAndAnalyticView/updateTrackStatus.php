<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageTrackingAndAnalyticController/manageTrackingAndAnalyticController.php';
date_default_timezone_set('Asia/Kuala_Lumpur');

session_start();

$tracking_ID = $_GET['tracking_ID'];

$tracking = new manageTrackingAndAnalyticController();
$status = new manageTrackingAndAnalyticController($tracking_ID);

$data1 = $tracking->viewStatus($tracking_ID);
$data2 = $status->viewProgress($tracking_ID);

if (isset($_POST['update'])) {
    $status->updateProgress($tracking_ID);
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Update Track Status | Runner - Turbo Runner Delivery Service</title>
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
    <?php
        foreach ($data1 as $row1) {
        ?>
        <h3>Tracking Number: <?=$row1['tracking_ID']?></h3>
        <?php } ?>
        <form action="" method="POST">
          <table class="table table-hover">
            <tr>
              <td>Date:</td>
              <td><input type="text" class="form-control" name="tracking_date" value="<?=date("d/m/Y") ?>" readonly></td>
              <td>Time:</td>
              <td><input type="text" class="form-control" name="tracking_time" value="<?=date("h:i:s a") ?>" readonly></td>
              <td>Progress:</td>
              <td>
                <select class="form-control" name="tracking_progress">
                  <option value="" disabled selected>---Choose Progress---</option>
                  <option value="Order accepted">Order accepted</option>
                  <option value="Order in process">Order in process</option>
                  <option value="Out of delivery">Out of delivery</option>
                  <option value="Delivered">Delivered</option>
                </select>
                <input type="hidden" name="status_ID" value="<?= $i ?>">
                <input type="hidden" name="tracking_ID" value="<?= $row1['tracking_ID'] ?>">
                <td><button type="submit" class="btn btn-warning" name="update">Update</button></td>
              </td>
            </tr>
          </table>
        </form>
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
              foreach ($data2 as $row2) { ?>
              <tr>
                <td><?=$row2['tracking_date']?></td>
                <td><?=$row2['tracking_time']?></td>
                <td><?=$row2['tracking_progress']?></td>
            <?php
              $i++;
            }
            ?>
            </tr>
        </table>
        <button type="button" class="btn btn-danger" onclick="location.href='../../ApplicationLayer/manageTrackingAndAnalyticView/runnerHomePage.php?runner_ID=<?=$_SESSION['runner_ID']?>'">Back</button>  
    </div>
  </body>
</html>
