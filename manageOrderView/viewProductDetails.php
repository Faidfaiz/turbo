<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageOrderController/manageOrderController.php';

session_start();
$service_ID = $_GET['service_ID'];

$service = new manageOrderController();
$data = $service->viewProductDetails($service_ID); 

if(isset($_POST['addToCart'])){
  $service->addToCart();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Product Details | Customer - Turbo Runner Delivery Service</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <script>
      jQuery(document).ready(function(){
      // This button will increment the value
      $('.button-plus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
        // Increment
          $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
        // Otherwise put a 0 there
          $('input[name='+fieldName+']').val(0);
            }
        });
        // This button will decrement the value till 0
        $(".button-minus").click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name='+fieldName+']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0);
            }
        });
    });
    </script>
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
        <li><a href="../manageUserProfileView/custProfile.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="../manageTrackingAndAnalyticView/custTrack.php?cust_ID=<?=$_SESSION['cust_ID']?>"><span class="glyphicon glyphicon-map-marker"></span> Track</a></li>
        <li><a href="../manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div style="margin-left: 100px">
    <h2>Product Details</h2>
  <br><br>
  </div>
  <hr>
  <div class="container">
    <form action="" method="POST">
      <table width="100%" border="0" cellspacing="0" cellpadding="15">
        <tr>
          <?php foreach ($data as $row) { ?>
          <td width=20% valign="top"><img src="<?=$row['product_image']?>" alt="" height="250" width="250"></td>
          <td width=80% valign="top"><h3><?=$row['product_name']?></h3>
            <p>Product Details: <?=$row['product_details']?></p>
            <input type="hidden" name="product_unit_price" value="<?=$row['product_unit_price']?>">
            <p>Unit Price: RM<?=$row['product_unit_price']?></p>
            <p>
              <div class="col-sm-3">
                <div class="input-group">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-danger button-minus"  data-type="minus" field="quantity">
                      <span class="glyphicon glyphicon-minus"></span>
                    </button>
                  </span>
                  <input type="text" name="quantity" class="form-control input-sm" value="1" min="1" max="100">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-success button-plus" data-type="plus" field="quantity">
                      <span class="glyphicon glyphicon-plus"></span>
                    </button>
                  </span>
                </div>
              </div>
            </p>
            <button type="submit" name="addToCart" class="btn btn-primary">Add To Cart</button>
            <button type="button" class="btn btn-danger" onclick="location.href='../manageOrderView/custHomePage.php?cust_ID=<?=$_SESSION['cust_ID']?>'">Back</button>
          </td>
         <?php } ?>
        </tr>
      </table>
    </form>
    </div>
  </body>
</html>
