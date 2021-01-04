<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageOrderController/manageOrderController.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/managePaymentController/managePaymentController.php';

session_start();

$service = new manageOrderController();
$payment = new managePaymentController();

$total_quantity = 0;
$total_price = 0;

$data = $service->viewCart(); 
$address = $payment->viewAddress();

if(isset($_POST['add'])){
  $payment->addPayment();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Checkout Page | Customer - Turbo Runner Delivery Service</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=ATF9RU9HKf9oLc7HtTzZXE7iHjYMWMuQVInQO6K_l3NsGU-PMhkSV5Xk8TRR54o25LOdH0djs1tgbUSZ&currency=MYR">
        // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>
    <style type="text/css">
    	th, input{
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
        <li><a href="..//manageLoginAndRegisterView/index.html"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </nav>

  <div style="margin-left: 120px">
  	<?php foreach ($address as $address) { ?>
  		<table>
  			<tr><strong>Delivery Address :</strong></tr>
  			<tr><?= $address['cust_add1'] . ', ' . $address['cust_add2'] . ', ' . $address['cust_postal_code'] . ', ' . $address['cust_city'] . ', ' . $address['cust_state'] ?></tr>
  			   <?php $_SESSION['shipping_address'] = $address['cust_add1'] . ', ' . $address['cust_add2'] . ', ' . $address['cust_postal_code'] . ', ' . $address['cust_city'] . ', ' . $address['cust_state'] ?>
  		</table>
    <?php } ?>
  </div>
  <br>
  <br>
  	<div class="container">
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
        <input type="hidden" name="cart_ID" value="<?=$row["cart_ID"]?>">
        <?php $_SESSION['cart_ID'] = $row['cart_ID'] ?>
				<td><?=$row["product_name"] ?></td>
				<td><?=$row["product_unit_price"] ?></td>
				<td><input type="text" name="quantity" value="<?=$row['quantity']?>" class="noborder" readonly></td>
				<td><input type="text" name="product_unit_price" value="<?=number_format($price,2)?>" class="noborder" readonly></td>
				<td>
					<button type="submit" class="btn btn-success" name="add">Confirm</button>
				</td>
			</tr>
			</form>
			<?php 
				$total_quantity += $row["quantity"];
				$total_price += ($row["product_unit_price"]*$row["quantity"]);
				}
			?>
			<tr>
				<td colspan="2"><strong>Total</strong></td>
				<td><?=$total_quantity; ?></td>
				<td><strong><?=number_format($total_price, 2); ?></strong></td>
				<td></td>
			</tr>
			</table>
		</form>
	
	<div style="text-align: left;">
        <label style="color: red">***</label>Click the CONFIRM button(s) before PAY.<label style="color: red">***</label><br>
    </div>
	<p>Pay By: </p>
        <div id="paypal-button-container"></div>
        <script>
            paypal.Buttons({
                createOrder: function(data, actions) {
                    // This function sets up the details of the transaction, including the amount and line item details.
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                currency_code: 'MYR',
                                value: '<?= $total_price ?>',
                            },
                            shipping: {
                                name: {
                                    full_name: '<?= $address["cust_name"]; ?>'
                                },
                                address: {
                                    address_line_1: '<?= $address["cust_add1"]; ?>',
                                    address_line_2: '<?= $address["cust_add2"]; ?>',
                                    admin_area_2: '<?= $address["cust_city"]; ?>',
                                    admin_area_1: '<?= $address["cust_state"]; ?>',
                                    postal_code: '<?= $address["cust_postal_code"]; ?>',
                                    country_code: 'MY'
                                }
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    // This function captures the funds from the transaction.
                    return actions.order.capture().then(function(details) {
                        // This function shows a transaction success message to your buyer.
                        alert('Transaction completed by ' + '<?=$address['cust_name'];?>' );
                        window.location.href = "../managePaymentView/paymentSuccessful.php?cust_ID=<?=$_SESSION['cust_ID']?>"
                    });
                }
            }).render('#paypal-button-container');
            //This function displays Smart Payment Buttons on your web page.
            </script>
    </div>
  </body>
 </html>