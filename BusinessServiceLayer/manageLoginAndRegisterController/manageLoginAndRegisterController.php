<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageLoginAndRegisterModel/manageLoginAndRegisterModel.php';

class manageLoginAndRegisterController{
    
   //This function is to allow the customer to register account by providing his personal information 
    function cReg(){
        $cust = new manageLoginAndRegisterModel();
        $cust->cust_name = $_POST['cust_name'];
        $cust->cust_phone = $_POST['cust_phone'];
        $cust->cust_add1 = $_POST['cust_add1'];
        $cust->cust_add2 = $_POST['cust_add2'];
        $cust->cust_postal_code = $_POST['cust_postal_code'];
        $cust->cust_city = $_POST['cust_city'];
        $cust->cust_state = $_POST['cust_state'];
        $cust->cust_email = $_POST['cust_email'];
        $cust->cust_password = $_POST['cust_password'];
        if($cust->cReg()){
            $message = "Your registration are SUCCESSFULLY!";
		      echo "<script type='text/javascript'>alert('$message');
		      window.location ='/sdw/ApplicationLayer/manageLoginAndRegisterView/clogin.php';</script>";
        }
    }

    //to allow the customer to login  to the system by use their email and password
    function cLogin(){
        $cust = new manageLoginAndRegisterModel();
        $cust->cust_email = $_POST['cust_email'];
        $cust->cust_password = $_POST['cust_password'];
        $stmt = $cust->cLogin();
        if ($stmt->rowCount()==1){
            session_start();
            foreach ($stmt as $selected) {
                $_SESSION['cust_ID'] = $selected['cust_ID'];
            }
            $_SESSION["cust_email"] = $_POST['cust_email'];
            echo "<script>alert('Login Succesful! Welcome to Turbo Runner Delivery System');
            window.location = '/sdw/ApplicationLayer/manageOrderView/custHomePage.php?cust_ID=".$_SESSION['cust_ID']."';</script>"; 
        }
        else {
            echo "<script type='text/javascript'>alert('Wrong email and password!Please try again!!!');
            window.location = '/sdw/ApplicationLayer/manageLoginAndRegisterView/clogin.php';</script>";
        }
    }

    //To allow the service provider to register acoount to the system 
    function spReg(){
        $sp = new manageLoginAndRegisterModel();
        $sp->sp_type = $_POST['sp_type'];
        $sp->sp_name = $_POST['sp_name'];
        $sp->sp_phone = $_POST['sp_phone'];
        $sp->sp_location = $_POST['sp_location'];
        $sp->sp_ssmcode = $_POST['sp_ssmcode'];
        $sp->sp_email = $_POST['sp_email'];
        $sp->sp_password = $_POST['sp_password'];
        if($sp->spReg()){
            $message = "Your registration are SUCCESSFULLY!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = '/sdw/ApplicationLayer/manageLoginAndRegisterView/splogin.php';</script>";
        }
    }

    //To allow the service provider to login to the system by entering the registered email and password
    function spLogin(){
        $sp = new manageLoginAndRegisterModel();
        $sp->sp_email = $_POST['sp_email'];
        $sp->sp_password = $_POST['sp_password'];
        $stmt = $sp->spLogin();
        if ($stmt->rowCount()==1){
            session_start();
            foreach ($stmt as $selected) {
                $_SESSION['sp_ID'] = $selected['sp_ID'];
            }
            $_SESSION["sp_email"] = $_POST['sp_email'];
            echo "<script>alert('Login Succesful! Welcome to Turbo Runner Delivery System');
            window.location = '/sdw/ApplicationLayer/manageServiceView/spHomePage.php?sp_ID=".$_SESSION['sp_ID']."';</script>"; 
        }
        else {
            echo "<script type='text/javascript'>alert('Wrong email and password!Please try again!!!');
            window.location = '/sdw/ApplicationLayer/manageLoginAndRegisterView/splogin.php';</script>";
        }
    }

    //To allow the runner to register to the system 
    function rReg(){
        $rn = new manageLoginAndRegisterModel();
        $rn->runner_name = $_POST['runner_name'];
        $rn->runner_phone = $_POST['runner_phone'];
        $rn->runner_license_id = $_POST['runner_license_id'];
        $rn->runner_vehicle_type = $_POST['runner_vehicle_type'];
        $rn->runner_email = $_POST['runner_email'];
        $rn->runner_password = $_POST['runner_password'];
        if($rn->rReg()){
            $message = "Your registration are SUCCESSFULLY!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = '/sdw/ApplicationLayer/manageLoginAndRegisterView/rlogin.php';</script>";
        }
    }

    //To allaw the runners to Login to the system by entering the registered email and password
    function rLogin(){
        $rn = new manageLoginAndRegisterModel();
        $rn->runner_email = $_POST['runner_email'];
        $rn->runner_password = $_POST['runner_password'];
        $stmt = $rn->rLogin();
        if ($stmt->rowCount()==1){
            session_start();
            foreach ($stmt as $selected) {
                $_SESSION['runner_ID'] = $selected['runner_ID'];
            }
            $_SESSION["runner_email"] = $_POST['runner_email'];
            echo "<script>alert('Login Succesful! Welcome to Turbo Runner Delivery System');
            window.location = '/sdw/ApplicationLayer/manageTrackingAndAnalyticView/runnerHomePage.php?runner_ID=".$_SESSION['runner_ID']."';</script>";
        }
        else {
            echo "<script type='text/javascript'>alert('Wrong email and password!Please try again!!!');
            window.location = '/sdw/ApplicationLayer/manageLoginAndRegisterView/rlogin.php';</script>";
        }
    }
}
?>
