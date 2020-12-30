<?php

class manageLoginAndRegisterModel{
    
    public $cust_ID, $cust_name, $cust_phone, $cust_add1, $cust_add2, $cust_postal_code, $cust_city, $cust_state, $cust_email, $cust_password, $sp_ID, $sp_type, $sp_name, $sp_phone, $sp_location, $sp_ssmcode, $sp_email,	$sp_password, $runner_ID, $runner_name, $runner_phone, $runner_license_id, $runner_vehicle_type, $runner_email, $runner_password;
    
    //connect to database named trds
    function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=trds', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

     //This function is to enter the customer information to the customer data base 
    function cReg(){
        $sql = "insert into customer(cust_name, cust_phone, cust_add1, cust_add2, cust_postal_code, cust_city, cust_state, cust_email, cust_password) values(:cust_name, :cust_phone, :cust_add1, :cust_add2, :cust_postal_code, :cust_city, :cust_state, :cust_email, :cust_password)";
        $args = [':cust_name'=>$this->cust_name, ':cust_phone'=>$this->cust_phone, ':cust_add1'=>$this->cust_add1, ':cust_add2'=>$this->cust_add2, ':cust_postal_code'=>$this->cust_postal_code, ':cust_city'=>$this->cust_city, ':cust_state'=>$this->cust_state, ':cust_email'=>$this->cust_email, ':cust_password'=>$this->cust_password];
        $stmt = manageLoginAndRegisterModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //This function is to allow  the customer to enter to the system by checking whether the email and password is simillar to the customer login information  
    function cLogin(){
    	$sql = "select * from customer where cust_email=:cust_email and cust_password=:cust_password";
    	$args = [':cust_email'=>$this->cust_email, ':cust_password'=>$this->cust_password];
        $stmt = manageLoginAndRegisterModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //This function is to enter the service provider information to the service provider data base
    function spReg(){
    	$sql = "insert into `service provider`(sp_type, sp_name, sp_phone, sp_location, sp_ssmcode, sp_email,	sp_password) values(:sp_type, :sp_name, :sp_phone, :sp_location, :sp_ssmcode, :sp_email, :sp_password)";
        $args = [':sp_type'=>$this->sp_type, ':sp_name'=>$this->sp_name, ':sp_phone'=>$this->sp_phone, ':sp_location'=>$this->sp_location, ':sp_ssmcode'=>$this->sp_ssmcode,':sp_email'=>$this->sp_email, ':sp_password'=>$this->sp_password];
        $stmt = manageLoginAndRegisterModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //This function is to allow  the service provider to enter to the system by checking whether the email and password is simillar to the service provider login information
    function spLogin(){
    	$sql = "select * from `service provider` where sp_email=:sp_email and sp_password=:sp_password";
    	$args = [':sp_email'=>$this->sp_email, ':sp_password'=>$this->sp_password];
        $stmt = manageLoginAndRegisterModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;   
    }

    //This function is to enter the runner information to the runner data base
    function rReg(){
    	$sql = "insert into runner(runner_name, runner_phone, runner_license_id, runner_vehicle_type, runner_email, runner_password) values(:runner_name, :runner_phone, :runner_license_id, :runner_vehicle_type, :runner_email, :runner_password)";
        $args = [':runner_name'=>$this->runner_name, ':runner_phone'=>$this->runner_phone, ':runner_license_id'=>$this->runner_license_id, ':runner_vehicle_type'=>$this->runner_vehicle_type,':runner_email'=>$this->runner_email, ':runner_password'=>$this->runner_password];
        $stmt = manageLoginAndRegisterModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //This function is to allow  the runner to enter to the system by checking whether the email and password is simillar to the runner login information
    function rLogin(){
    	$sql = "select * from runner where runner_email=:runner_email and runner_password=:runner_password";
    	$args = [':runner_email'=>$this->runner_email, ':runner_password'=>$this->runner_password];
    	$stmt = manageLoginAndRegisterModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
?>

