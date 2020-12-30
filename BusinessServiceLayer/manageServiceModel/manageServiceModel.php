<?php

class manageServiceModel{
    public $product_category, $product_name, $product_image, $product_details, $product_unit_price;
    
    //connect to database named trds
    function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=trds', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    // TO add the  new product to the  service table 
    function addService(){
        $sql = "insert into service(sp_ID, product_category, product_name, product_image, product_details, product_unit_price) values(:sp_ID, :product_category, :product_name, :product_image, :product_details, :product_unit_price)";
        $args = [':sp_ID'=>$this->sp_ID, ':product_category'=>$this->product_category, ':product_name'=>$this->product_name, ':product_image'=>$this->product_image, ':product_details'=>$this->product_details, ':product_unit_price'=>$this->product_unit_price];
        $stmt = manageServiceModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    // To retrive all the information of the products that stored in the system
    function viewAllService(){
        $sql = "select * from service where sp_ID = :sp_ID";
        $args = [':sp_ID'=>$this->sp_ID];
        $stmt = manageServiceModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //To retrive the full information for the specific product from the service table
    function viewServiceDetails(){
        $sql = "select * from service where service_ID = :service_ID";
        $args = [':service_ID'=>$this->service_ID];
        $stmt = manageServiceModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //To update  the product with the new information
    function editServiceDetails(){
        $sql = "update service set product_name=:product_name,  product_details=:product_details, product_unit_price=:product_unit_price where sp_ID = :sp_ID and service_ID = :service_ID";
        $args = [':sp_ID'=>$this->sp_ID, ':service_ID'=>$this->service_ID, ':product_name'=>$this->product_name, ':product_details'=>$this->product_details, ':product_unit_price'=>$this->product_unit_price];
        $stmt = manageServiceModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    ///To delete the product from the service table
    function deleteService(){
        $sql = "delete from service where service_ID=:service_ID";
        $args = [':service_ID'=>$this->service_ID];
        $stmt = manageServiceModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
?>
