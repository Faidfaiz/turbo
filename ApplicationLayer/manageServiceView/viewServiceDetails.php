<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageServiceController/manageServiceController.php';

session_start();
$service_ID = $_GET['service_ID'];

$service = new manageServiceController();
$data = $service->viewServiceDetails($service_ID); 

if(isset($_POST['editService'])){
  $service->editServiceDetails($service_ID);
}

if(isset($_POST['deleteService'])){
  $service->deleteService($service_ID);
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Service Details | Service Provider - Turbo Runner Delivery Service</title>
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
        var x = document.getElementById("product_mage").files[0];
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

  <div class="container">
      <div class="ps-container">
        <h3 class="ps-section__title">My Product Details</h3>
      </div> 
      <form action="" method="POST">
        <div class="form">
          <?php foreach($data as $row) { ?>
            <div class="column">
              <a href="#"><img src="<?=$row['product_image']?>" width="250" height="250"></a>
                <div class="row">
                  <div class="col-xs-4">
                    <label>Product Name</label>
                    <input class="form-control" name="product_name" value="<?=$row['product_name']?>" readonly>
                  </div>
                  <div class="col-xs-4">
                    <label>Product Details</label>
                    <input class="form-control" name="product_details" value="<?=$row['product_details']?>" readonly>
                  </div>
                  <div class="col-xs-4">
                    <label>Product Unit Price(RM)</label>
                    <input class="form-control" name="product_unit_price" value="<?=$row['product_unit_price']?>" readonly>                        
                  </div>
                </div>
                <br>
            </div>
          <?php } ?>
         <button type="button" class="btn btn-primary" onclick="location.href='../manageServiceView/spHomePage.php?sp_ID=<?=$_SESSION['sp_ID']?>'">Cancel</button>
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal">Edit Details</button>
          <button type="submit" name="deleteService" onClick="javascript: return confirm('Please confirm deletion');" class="btn btn-danger" ">Delete</button>
        </div>
      </form>
    </div>

    <!-- Modal -->
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Edit Product | Service Provider</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <label>Product Name</label>
                  <input type="text" class="form-control" name="product_name" value="<?=$row['product_name']?>" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <label>Product Details</label>
                  <input type="text" class="form-control" name="product_details" value="<?=$row['product_details']?>" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <label>Product Unit Price</label>
                  <input type="text" class="form-control" name="product_unit_price" value="<?=$row['product_unit_price']?>" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="editService" class="btn btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>