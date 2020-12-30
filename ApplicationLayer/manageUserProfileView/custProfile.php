<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageUserProfileController/manageUserProfileController.php';

$cust_ID = $_GET['cust_ID'];

$cust = new manageUserProfileController();
$data = $cust->viewCust($cust_ID); 

if(isset($_POST['editCustProfile'])){
  $cust->editCust();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Profile | Customer - Turbo Runner Delivery Service</title>
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
        <?php foreach($data as $row) { ?>
          <a class="navbar-brand" href="#">Welcome to Turbo Runner Delivery System, <?=$row['cust_name']?></a>
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
        <li><a href="../manageUserProfileView/custProfile.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/custTrack.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-map-marker"></span> Track</a></li>
        <li><a href="..//manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>
    <h3 style="margin-left: 1em; margin-top: 1em;text-decoration: underline;">Customer Profile</h3>
      <div style="margin-left: 1em;">
          <div class="form">
          <div class="row">
            <div class="col-xs-4">
            <label>Customer Name</label>
            <input type="text" class="form-control" name="cust_name" value="<?=$row['cust_name']?>" readonly>
          </div>
          </div>
          <br />
          <div class="row">
            <div class="col-xs-4">
              <label>Customer Phone</label>
              <input class="form-control" name="cust_phone" value="<?=$row['cust_phone']?>" readonly>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <label>Customer Address</label>
              <input type="text" class="form-control" name="cust_add1" value="<?=$row['cust_add1']?>, <?=$row['cust_add2']?>, <?=$row['cust_postal_code']?>, <?=$row['cust_city']?>, <?=$row['cust_state']?>" readonly>
            </div>
          </div>
          <br />
          <div class="row">
            <div class="col-xs-4">
              <label>Customer Email</label>
              <input class="form-control" name="cust_email" value="<?=$row['cust_email']?>" readonly>
            </div>
          </div>
          <br />
          <button type="button" class="btn btn-danger" onclick="location.href='../../ApplicationLayer/manageOrderView/custHomePage.php?cust_ID=<?=$_SESSION['cust_ID']?>'">Cancel</button>
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
                  <input type="text" class="form-control" name="cust_name" value="<?=$row['cust_name']?>" autofocus required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                  <input type="text" class="form-control" name="cust_phone" placeholder="Phone Number" value="<?=$row['cust_phone']?>" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                  <input type="text" class="form-control" name="cust_add1" value="<?=$row['cust_add1']?>" required>
                  <input type="text" class="form-control" name="cust_add2" value="<?=$row['cust_add2']?>" required>
                  <input type="text" class="form-control" name="cust_postal_code" value="<?=$row['cust_postal_code']?>"  required>
                  <input type="text" class="form-control" name="cust_city" value="<?=$row['cust_city']?>"  required>
                  <input type="text" class="form-control" name="cust_state" value="<?=$row['cust_state']?>"  required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="editCustProfile" class="btn btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
