<?php

session_start();

class manageUserProfileModel{
    public $cust_ID, $cust_name, $cust_phone, $cust_add1, $cust_add2, $cust_postal_code, $cust_city, $cust_state, $cust_email, $cust_password, $sp_ID, $sp_type, $sp_name, $sp_phone, $sp_location, $sp_ssmcode, $sp_email, $sp_password, $runner_ID, $runner_name, $runner_phone, $runner_lisence_id, $runner_vehicle_type, $runner_email, $runner_password;
    
    //connect to database named trds
    function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=trds', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    //To retrive the customer profile information from the customer table
    function viewCustProfile(){
        $sql = "select * from customer where cust_ID = :cust_ID";
        $args = [':cust_ID'=>$this->cust_ID];
        $stmt = manageUserProfileModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //To update the customer table with the new customer information
    function editCustProfile(){
        $sql = "update customer set cust_name=:cust_name, cust_phone=:cust_phone, cust_add1=:cust_add1, cust_add2=:cust_add2, cust_postal_code=:cust_postal_code, cust_city=:cust_city, cust_state=:cust_state where cust_ID = :cust_ID";
        $args = [':cust_ID'=>$this->cust_ID, ':cust_name'=>$this->cust_name, ':cust_phone'=>$this->cust_phone, ':cust_add1'=>$this->cust_add1, ':cust_add2'=>$this->cust_add2, ':cust_postal_code'=>$this->cust_postal_code, ':cust_city'=>$this->cust_city, ':cust_state'=>$this->cust_state];
        $stmt = manageUserProfileModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //To retrive the Service provider profile information from the service provider table
    function viewSPProfile(){
        $sql = "select * from `service provider` where sp_ID = :sp_ID";
        $args = [':sp_ID'=>$this->sp_ID];
        $stmt = manageUserProfileModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //To update the Service provider table with the new Service provider information
    function editSPProfile(){
        $sql = "update `service provider` set sp_name=:sp_name, sp_phone=:sp_phone, sp_location=:sp_location where sp_ID = :sp_ID";
        $args = [':sp_ID'=>$this->sp_ID, ':sp_name'=>$this->sp_name, ':sp_phone'=>$this->sp_phone, ':sp_location'=>$this->sp_location];
        $stmt = manageUserProfileModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //To retrive the Runner profile information from the runner table
    function viewRunnerProfile(){
        $sql = "select * from runner where runner_ID = :runner_ID";
        $args = [':runner_ID'=>$this->runner_ID];
        $stmt = manageUserProfileModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //To update the Runners table with the new Runner information
    function editRunnerProfile(){
        $sql = "update runner set runner_name=:runner_name, runner_phone=:runner_phone, runner_vehicle_type=:runner_vehicle_type where runner_ID = :runner_ID";
        $args = [':runner_ID'=>$this->runner_ID, ':runner_name'=>$this->runner_name, ':runner_phone'=>$this->runner_phone, ':runner_vehicle_type'=>$this->runner_vehicle_type];
        $stmt = manageUserProfileModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
?>

