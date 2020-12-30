<?php

class manageOrderModel{
    public $cart_ID, $service_ID, $cust_ID, $product_category, $payment_status, $quantity, $product_unit_price;
    
    //connect to database named trds
    function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=trds', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    //view all product menu in customer Home Page 
    function viewAllProduct(){
        $sql = "select * from service";
        return manageOrderModel::connect()->query($sql);
    }

    //view product details
    function viewProductList()
    {
        $sql = "select * from service where product_category = :product_category";
        $args = [':product_category' => $this->product_category];
        $stmt = manageOrderModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //view product details
    function viewProductDetails(){
        $sql = "select * from service where service_ID = :service_ID";
        $args = [':service_ID'=>$this->service_ID];
        $stmt = manageOrderModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //search product by key in the name
    function searchProduct() {
        $sql = "select * from service where product_name = :search";
        $args = [':search'=>$this->search];
        $stmt = manageOrderModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //add the product into cart
    function addToCart(){
        $sql = "insert into cart(cust_ID, service_ID, payment_status, quantity, product_unit_price) values (:cust_ID, :service_ID, :payment_status, :quantity, :product_unit_price)";
        $args = [':cust_ID'=>$this->cust_ID, ':service_ID'=>$this->service_ID, ':payment_status'=>'0', ':quantity'=>$this->quantity, ':product_unit_price'=>$this->product_unit_price];
        $stmt = manageOrderModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //view the cart 
    function viewCart(){
        $sql = "select * from (cart inner join service on cart.service_ID = service.service_ID) where cust_ID = :cust_ID and payment_status = 0";
        $args = [':cust_ID'=>$this->cust_ID];
        $stmt = manageOrderModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //update the quantity of product in cart
    function updateCart(){
        $sql = "update cart set quantity=:quantity where service_ID = :service_ID";
        $args = [':service_ID'=>$this->service_ID, ':quantity'=>$this->quantity];
        $stmt = manageOrderModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //delete the product from cart
    function deleteCart(){
        $sql = "delete from cart where service_ID = :service_ID";
        $args = [':service_ID'=>$this->service_ID];
        $stmt = manageOrderModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
?>
