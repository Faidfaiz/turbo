<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageUserProfileController/manageUserProfileController.php';

$sp_ID = $_GET['sp_ID'];

$sp = new manageUserProfileController();
$data = $sp->viewSP($sp_ID); 

if(isset($_POST['editSPProfile'])){
  $sp->editSP();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Profile | Service Provider - Turbo Runner Delivery Service</title>
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
        <li><a href="../../ApplicationLayer/manageServiceView/addService.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-briefcase"></span> Add Product</a></li>
        <li><a href="../../ApplicationLayer/manageUserProfileView/spProfile.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../../ApplicationLayer/manageTrackingAndAnalyticView/spAnalytic.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-screenshot"></span> Analytic</a></li>
        <li><a href="../../ApplicationLayer/manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>
    <h3 style="margin-left: 1em; margin-top: 1em;text-decoration: underline;">Service Provider Profile</h3>
      <div style="margin-left: 1em;">
          <div class="form">
          <?php foreach($data as $row) { 
            $_SESSION['sp_ID']=$row['sp_ID'];
          ?>     
          <div class="row">
            <div class="col-xs-4">
            <label>Service Provider Name</label>
            <input type="text" class="form-control" value="<?=$row['sp_name']?>" readonly>
          </div>
          </div>
          <br />
          <div class="row">
            <div class="col-xs-4">
              <label>Service Provider Phone</label>
              <input class="form-control" value="<?=$row['sp_phone']?>" readonly>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <label>Service Provider Location</label>
              <input type="text" class="form-control" value="<?=$row['sp_location']?>" readonly>
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-xs-4">
              <label>Service Provider SSM Code</label>
              <input type="text" class="form-control" value="<?=$row['sp_ssmcode']?>" readonly>
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-xs-4">
              <label>Service Provider Email</label>
              <input class="form-control" name="cust_email" value="<?=$row['sp_email']?>" readonly>
            </div>
          </div>
          <br />
          <button type="button" class="btn btn-danger" onclick="location.href='../../ApplicationLayer/manageServiceView/spHomePage.php?sp_ID=<?=$_SESSION['sp_ID']?>'">Cancel</button>
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
              <h3 class="modal-title">Edit Profile | Customer</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input type="text" class="form-control" name="sp_name" value="<?=$row['sp_name']?>" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                  <input type="text" class="form-control" name="sp_phone" value="<?=$row['sp_phone']?>" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></i></span>
                  <input type="text" class="form-control" name="sp_location" value="<?=$row['sp_location']?>" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="editSPProfile" class="btn btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
