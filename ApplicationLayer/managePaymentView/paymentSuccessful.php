<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/managePaymentController/managePaymentController.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageTrackingAndAnalyticController/manageTrackingAndAnalyticController.php';

session_start();

$payment = new managePaymentController();
$tracking = new manageTrackingAndAnalyticController();

$total_quantity = 0;
$total_price = 0;

$data = $payment->viewReceipt();
$address = $payment->viewAddress();

if(isset($_POST['add'])){
    $payment->updatePaymentStatus();
    echo "<script>;
    window.location = '../manageOrderView/custHomePage.php?cust_ID=".$_SESSION['cust_ID']."'</script>";
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="images/logo.jpg">
        <title>Payment Successful | Customer - Turbo Runner Delivery Service</title>
        <link rel="stylesheet" type="text/css" href="css/all.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
        <style type="text/css">
            td {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <form action="" method="POST">
            <div class="container">
                <h1>Payment Success!!!</h1>
                <br><br><br>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#receiptModal">View Receipt</button>
                <button type="submit" class="btn btn-primary" name="add">Return To Home Page</button>
            </div>
        </form>

    <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" style="text-align: center">Receipt</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php foreach($address as $cust) { ?>
                <label>Customer Name: <?= $cust['cust_name'] ?></label>
                <label>Shipping Address: <?= $cust['cust_add1'] . ', ' . $cust['cust_add2'] . ', ' . $cust['cust_postal_code'] . ', ' . $cust['cust_city'] . ', ' . $cust['cust_state'] ?></label>
                <?php } ?>
                <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Unit Price(RM)</th>
                    <th>Quantity</th>
                    <th>Price(RM)</th>
                </tr>
                <?php foreach($data as $row) { 
                    $price = $row["quantity"]*$row["product_unit_price"]; 
                ?>
                <tr>
                    <td><?=$row["product_name"] ?></td>
                    <td><?=$row["product_unit_price"] ?></td>
                    <td><?=$row['quantity']?></td>
                    <td><?=number_format($price,2)?></td>
                </tr>
                <?php 
                    $total_quantity += $row["quantity"];
                    $total_price += ($row["product_unit_price"]*$row["quantity"]);
                    }
                ?>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td><?=$total_quantity; ?></td>
                    <td><strong><?=number_format($total_price, 2); ?></strong></td>
                </tr>
            </table>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
</body>
</html>