<?php

class manageTrackingAndAnalyticModel{
    public $tracking_ID, $cust_ID, $cart_ID, $runner_ID, $runner_status, $shipping_status, $shipping_address;

    //connect to database named trds
    function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=trds', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    //runner accept the task
    function acceptTask()
    {
        $sql = "update tracking set runner_status = :runner_status, runner_ID = :runner_ID where tracking_ID = :tracking_ID";
        $args = [':tracking_ID' => $this->tracking_ID, ':runner_status' => 'Accepted', ':runner_ID' => $this->runner_ID];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //runner reject the task
    function rejectTask()
    {
        $sql = "update tracking set runner_status = :runner_status, runner_ID = :runner_ID where tracking_ID = :tracking_ID";
        $args = [':tracking_ID' => $this->tracking_ID, ':runner_status' => 'Unaccepted', ':runner_ID' => $this->runner_ID];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

     //view the task which is not accepted by other runner
    function viewUnacceptedTask()
    {
        $sql = "select * from tracking join customer on tracking.cust_ID = customer.cust_ID where runner_status='Unaccepted'";
        return manageTrackingAndAnalyticModel::connect()->query($sql);
    }

    //view the task which is accepted based on runner ID
    function viewAcceptedTask()
    {
        $sql = "select * from tracking join customer on tracking.cust_ID = customer.cust_ID where runner_status='Accepted' and runner_ID = :runner_ID and shipping_status not like 'Completed'";
        $args = [':runner_ID' => $this->runner_ID];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //customer can view the status when they track their product
    function viewStatus()
    {
        $sql = "select * from tracking where tracking_ID = :tracking_ID";
        $args = [':tracking_ID' => $this->tracking_ID];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //runner can update the status by date and time of shipping product based on tracking ID
    function updateProgress()
    {
        $sql = "insert into status(tracking_ID, status_ID, tracking_date, tracking_time, tracking_progress) values(:tracking_ID, :status_ID, :tracking_date, :tracking_time, :tracking_progress)";
        $args = [':tracking_ID' => $this->tracking_ID, ':status_ID' => $this->status_ID, ':tracking_date' => $this->tracking_date, ':tracking_time' => $this->tracking_time, ':tracking_progress' => $this->tracking_progress,];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //runner can view the progress by date and time based on tracking ID
    function viewProgress()
    {
        $sql = "select * from status where tracking_ID = :tracking_ID";
        $args = [':tracking_ID' => $this->tracking_ID];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //customer can view all product which on delivery
    function viewTrackingList()
    {
        $sql = "select *  from (tracking inner join cart on tracking.cart_ID = cart.cart_ID) inner join service on cart.service_ID = service.service_ID where tracking.shipping_status like 'On Delivery' and tracking.cust_ID=:cust_ID";
        $args = [':cust_ID' => $this->cust_ID];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //customer update the status of delivery which is 'Completed' once he/she received the product
    function updateDeliveryStatus()
    {
        $sql = "update tracking set shipping_status = :shipping_status where tracking_ID = :tracking_ID";
        $args = [':tracking_ID' => $this->tracking_ID, ':shipping_status' => 'Completed'];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //service provider can view the total sales
    function viewSales()
    {
        $sql = "select * from (cart inner join service on cart.service_ID = service.service_ID) where sp_ID = :sp_ID";
        $args = [':sp_ID' => $this->sp_ID];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //runner can view the total task he accepted
    function viewDelivery()
    {
        $sql = "select *, (select count(*) from tracking where runner_ID = :runner_ID) as count from tracking where runner_ID = :runner_ID";
        $args = [':runner_ID' => $this->runner_ID];
        $stmt = manageTrackingAndAnalyticModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
?>
