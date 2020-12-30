<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageOrderController/manageOrderController.php';

session_start();

$service = new manageOrderController();
$data = $service->viewCart(); 

$total_quantity = 0;
$total_price = 0;

if(isset($_POST['delete'])){
	$service->deleteCart();
}

if(isset($_POST['update'])) {
    $service->updateCart();
}

if(isset($_POST['checkout'])) {
    echo "<script>;
   	window.location = '../managePaymentView/checkout.php?cust_ID=".$_SESSION['cust_ID']."'</script>";
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Shopping Cart | Customer - Turbo Runner Delivery Service</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <style type="text/css">
    	th {
    		text-align: center;
    	}
    </style>
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
  	<div class="container">
	  	<h1>Shopping Cart</h1>
			<form action="" method="POST">
		  	<table class="table table-bordered" style="text-align: center;">
			<tr>
				<th>Name</th>
				<th>Unit Price(RM)</th>
				<th>Quantity</th>
				<th>Price(RM)</th>
				<th>Action</th>
			</tr>
			<?php foreach ($data as $row) { 
				$price = $row["quantity"]*$row["product_unit_price"]; 
			?>
			<form action="" method="POST">
			<tr>
        <input type="hidden" name="service_ID" value="<?=$row["service_ID"];?>">
				<td><img src="<?=$row["product_image"]; ?>" width="150" height="150"/><?=$row["product_name"]; ?></td>
				<td><?=$row["product_unit_price"]; ?></td>
				<td><input type="number" name="quantity" value="<?=$row['quantity']?>" min="1" max="100" class="noborder" style="width: 3em;"></td>
				<td><?=number_format($price,2); ?></td>
				<td>
					<button type="submit" name="update" class="btn btn-primary" onclick="return confirm('Do you want to update the selected product.');">Update Quantity</button>
					<button type="submit" class="btn btn-danger" name="delete">Delete</button>
				</td>
			</tr>
			</form>
			<?php 
				$total_quantity += $row["quantity"];
				$total_price += ($row["product_unit_price"]*$row["quantity"]);
				}
			?>
			<tr>
				<td>Total:</td>
				<td></td>
				<td><?=$total_quantity; ?></td>
				<td colspan="1"><strong><?=number_format($total_price, 2); ?></strong></td>
				<td></td>
			</tr>
			</table>
			<br>
			<br>
      <button type="button" class="btn btn-danger" onclick="location.href='../manageOrderView/custHomePage.php?cust_ID=<?=$_SESSION['cust_ID']?>'">Back</button>
			<button type="submit" name="checkout" class="btn btn-warning">Check Out</button>
		</form>
	</div>
  </body>
 </html>