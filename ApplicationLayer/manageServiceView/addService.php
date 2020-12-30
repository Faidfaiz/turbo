<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageServiceController/manageServiceController.php';

session_start();
$service = new manageServiceController();

if(isset($_POST['add'])){
    $service->addService();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Add Service | Service Provider - Turbo Runner Delivery Service</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <script>
      var loadFile = function (event) {
        var image = document.getElementById("imageOut");
        image.src = URL.createObjectURL(event.target.files[0]);
      };

      function displayFile() {
        var x = document.getElementById("product_image").files[0];
        var y = x.name;
        document.myForm.product_image_name.value = y;
      }
    </script>
  </head>
  <body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Welcome to Turbo Runner Delivery System</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../manageServiceView/addService.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-briefcase"></span> Add Product</a></li>
        <li><a href="../manageUserProfileView/spProfile.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/spAnalytic.php?sp_ID=<?=$_SESSION['sp_ID']?>"><span class="glyphicon glyphicon-screenshot"></span> Analytic</a></li>
        <li><a href="../manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div style="margin-left: 100px">
    <h2>Add Product</h2>
    <p>Add your product here.</p>
      <form name="myForm" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <div class="input-group col-xs-3">
            <label>Service Type</label>   
            <select class="form-control" name="product_category" required>
              <option value="" disabled selected> --- Product Category --- </option>
              <option value="Food">Food</option>
              <option value="Goods">Goods</option>
              <option value="Pet Assist">Pet Assist</option>
              <option value="Medical">Medical</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group col-xs-3">
            <label>Product Name</label>
            <input type="text" class="form-control" name="product_name" placeholder="Product Name" autofocus required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group col-xs-3">
            <label>Product Image</label>
              <br />
              <image id="imageOut" width="120px" height="120px"></image>
              <input style="display: inline-block;" type="file" name="product_image" id="product_image" accept="image/*"onchange="loadFile(event)"/>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group col-xs-3">
            <label>Product Details</label>
            <input type="text" class="form-control" name="product_details" placeholder="Product Details" autofocus required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group col-xs-3">
            <label>Product Price (RM)</label>
            <input type="text" class="form-control" name="product_unit_price" placeholder="Product Price" autofocus required>
          </div>
        </div>
          <button type="submit" class="btn btn-success" name="add">Add Product</button>
          <button type="button" class="btn btn-danger" onclick="location.href='../manageServiceView/spHomePage.php?sp_ID=<?=$_SESSION['sp_ID']?>'">Cancel</button>
      </form>
    </div>
  </body>
</html>
