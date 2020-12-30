<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageUserProfileController/manageUserProfileController.php';

$runner_ID = $_GET['runner_ID'];

$rn = new manageUserProfileController();
$data = $rn->viewRunner($runner_ID); 

if(isset($_POST['editRunnerProfile'])){
  $rn->editRunner();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Profile | Runner - Turbo Runner Delivery Service</title>
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
    <h3 style="margin-left: 1em; margin-top: 1em;text-decoration: underline;">Runner Profile</h3>
      <div style="margin-left: 1em;">
          <div class="form">
          <?php foreach($data as $row) { 
            $_SESSION['runner_ID']=$row['runner_ID'];
          ?>     
          <div class="row">
            <div class="col-xs-4">
            <label>Runner Name</label>
            <input type="text" class="form-control" name="cust_name" value="<?=$row['runner_name']?>" readonly>
          </div>
          </div>
          <br />
          <div class="row">
            <div class="col-xs-4">
              <label>Runner Phone</label>
              <input type="text" class="form-control" value="<?=$row['runner_phone']?>" readonly>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <label>Runner Lisence ID</label>
              <input type="text" class="form-control" value="<?=$row['runner_license_id']?>" readonly>
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-xs-4">
              <label>Runner Vehicle Type</label>
              <input type="text" class="form-control" value="<?=$row['runner_vehicle_type']?>" readonly>
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-xs-4">
              <label>Runner Email</label>
              <input type="text" class="form-control" value="<?=$row['runner_email']?>" readonly>
            </div>
          </div>
          <br />
          <button type="button" class="btn btn-danger" onclick="location.href='../manageTrackingAndAnalyticView/runnerHomePage.php?runner_ID=<?=$_SESSION['runner_ID']?>'">Cancel</button>
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal">Edit Profile</button>
          <?php } ?>
        </div>
    </div>

    <!-- Modal -->
    <form action="" method="POST">
      <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Edit Profile | Runner</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input type="text" class="form-control" name="runner_name" value="<?=$row['runner_name']?>" autofocus required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                  <input type="number" class="form-control" name="runner_phone" value="<?=$row['runner_phone']?>" required>
                </div>
              </div>
              <div class="form-group">
                <select class="form-control" name="runner_vehicle_type">
                  <option value="" disabled selected> --- Vehicle Type --- </option>
                  <option value="Van">Van</option>
                  <option value="Car">Car</option>
                  <option value="Motor">Motor</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="editRunnerProfile" class="btn btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
