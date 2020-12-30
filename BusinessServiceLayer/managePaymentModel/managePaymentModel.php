<?php
class managePaymentModel {
    public $payment_ID, $cust_ID, $service_ID, $payment_status, $shipping_address, $quantity, $product_unit_price, $runner_status, $shipping_status;

    //connect to database named trds
    function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=trds', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    // To add payment data into to the payment table
    // And to save the tracking data inside the tracking table
    function addPayment(){
        $sql = "insert into payment(cust_ID, cart_ID, shipping_address, quantity, product_unit_price) values(:cust_ID, :cart_ID, :shipping_address, :quantity, :product_unit_price)";
        $args = [':cust_ID'=>$this->cust_ID, ':cart_ID'=>$this->cart_ID, ':shipping_address'=>$this->shipping_address, ':quantity'=>$this->quantity, ':product_unit_price'=>$this->product_unit_price];
        $stmt = managePaymentModel::connect()->prepare($sql);
        $stmt->execute($args);
        $sql = "insert into tracking(cust_ID, cart_ID, runner_status, shipping_status, shipping_address) values (:cust_ID, :cart_ID, :runner_status, :shipping_status, :shipping_address)";
        $args = [':cust_ID'=>$this->cust_ID, ':cart_ID'=>$this->cart_ID, ':runner_status' => 'Unaccepted', ':shipping_status'=>'On Delivery', ':shipping_address'=>$this->shipping_address];
        $stmt = managePaymentModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //view the shipping address in the checkout page
    function viewAddress(){
        $sql = "select * from customer where cust_ID = :cust_ID";
        $args = [':cust_ID' => $this->cust_ID];
        $stmt = managePaymentModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //update payment status in cart if the order already paid
    function updatePaymentStatus(){
        $sql = "update cart set payment_status= 1 where cust_ID = :cust_ID";
        $args = [':cust_ID' => $this->cust_ID];
        $stmt = managePaymentModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //view the receipt based on customer ID
    function viewReceipt(){
        $sql = "select * from (cart inner join service on cart.service_ID = service.service_ID) where cust_ID = :cust_ID and payment_status = 0";
        $args = [':cust_ID' => $this->cust_ID];
        $stmt = managePaymentModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
