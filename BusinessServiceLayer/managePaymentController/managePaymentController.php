<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/managePaymentModel/managePaymentModel.php';

class managePaymentController {

    //add the payment data
    function addPayment(){
        $payment = new managePaymentModel();
        $payment->cust_ID = $_SESSION['cust_ID'];
        $payment->cart_ID = $_POST['cart_ID'];
        $payment->quantity = $_POST['quantity'];
        $payment->product_unit_price = $_POST['product_unit_price'];
        $payment->shipping_address = $_SESSION['shipping_address'];
        if($payment->addPayment()){
            $message = "Your product have been confirmed!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = '/sdw/ApplicationLayer/managePaymentView/checkout.php?cust_ID=".$_SESSION['cust_ID']."';</script>";
        }
    }

    //view the shipping address in the checkout page
    function viewAddress(){
        $payment = new managePaymentModel();
        $payment->cust_ID = $_SESSION['cust_ID'];
        return $payment->viewAddress();
    }

    //update payment status in cart
    function updatePaymentStatus(){
        $payment = new managePaymentModel();
        $payment->cust_ID = $_SESSION['cust_ID'];
        $payment->updatePaymentStatus();
    }

    //view the receipt based on customer ID
    function viewReceipt(){
        $payment = new managePaymentModel();
        $payment->cust_ID = $_SESSION['cust_ID'];
        return $payment->viewReceipt();
    }
}
?>