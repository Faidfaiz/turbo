<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageTrackingAndAnalyticModel/manageTrackingAndAnalyticModel.php';

class manageTrackingAndAnalyticController{	

    //To allow the runner to accept the order delivery request
    function acceptTask()
    {
        $tracking = new manageTrackingAndAnalyticModel();
        $tracking->runner_ID = $_SESSION['runner_ID'];
        $tracking->tracking_ID = $_POST['tracking_ID'];
        if ($tracking->acceptTask()) {
            $message = "You are accept the task!";
            echo "<script type='text/javascript'>alert('$message');
        window.location = 'runnerHomePage.php?runner_ID=".$_SESSION['runner_ID']."';</script>";
        }
    }

    //To allow the runner to reject the order delivery request
    function rejectTask()
    {
        $tracking = new manageTrackingAndAnalyticModel();
        $tracking->runner_ID = $_SESSION['runner_ID'];
        $tracking->tracking_ID = $_POST['tracking_ID'];
        if ($tracking->rejectTask()) {
            $message = "You are reject the task!";
            echo "<script type='text/javascript'>alert('$message');
        window.location = 'runnerHomePage.php?runner_ID=".$_SESSION['runner_ID']."';</script>";
        }
    }

    //To allow the runners to view the tasks that are unaccepted yet 
    function viewUnacceptedTask()
    {
        $tracking = new manageTrackingAndAnalyticModel();
        return $tracking->viewUnacceptedTask();
    }

    //To view the accepted task of the runner based on runner ID
    function viewAcceptedTask()
    {
        $tracking = new manageTrackingAndAnalyticModel();
        $tracking->runner_ID = $_SESSION['runner_ID'];
        return $tracking->viewAcceptedTask();
    }

    //customer can view the status when they track their product
    function viewStatus($tracking_ID)
    {
        $tracking = new manageTrackingAndAnalyticModel();
        $tracking->tracking_ID = $tracking_ID;
        return $tracking->viewStatus();
    }

    //runner can update the status by date and time of shipping product based on tracking ID
    function updateProgress($tracking_ID)
    {
        $status = new manageTrackingAndAnalyticModel();
        $status->tracking_ID = $_POST['tracking_ID'];
        $status->status_ID = $_POST['status_ID'];
        $status->tracking_date = $_POST['tracking_date'];
        $status->tracking_time = $_POST['tracking_time'];
        $status->tracking_progress = $_POST['tracking_progress'];
        if ($status->updateProgress()) {
            $message = "Progress Update!";
            echo "<script type='text/javascript'>alert('$message');
        window.location = 'updateTrackStatus.php?tracking_ID=".$_POST['tracking_ID']."';</script>";
        }
    }

    //runner can view the progress by date and time based on tracking ID
    function viewProgress($tracking_ID)
    {
        $status = new manageTrackingAndAnalyticModel();
        $status->tracking_ID = $tracking_ID;
        return $status->viewProgress();
    }

    //customer can view all product which on delivery
    function viewTrackingList()
    {
        $tracking = new manageTrackingAndAnalyticModel();
        $tracking->cust_ID = $_SESSION['cust_ID'];
        return $tracking->viewTrackingList();
    }

    //customer update the status of delivery which is 'Completed' once he/she received the product
    function updateDeliveryStatus()
    {
        $status = new manageTrackingAndAnalyticModel();
        $status->tracking_ID = $_POST['received'];
        $status->updateDeliveryStatus();
        echo "<script type='text/javascript'>alert('Thanks for using Turbo Runner Delivery System');
        window.location = 'custTrack.php?cust_ID=".$_SESSION['cust_ID']."';</script>";
    }

    //service provider can view the total sales
    function viewSales($sp_ID){
        $tracking = new manageTrackingAndAnalyticModel();
        $tracking->sp_ID = $sp_ID;
        return $tracking->viewSales();
    }

    //runner can view the total task he accepted
    function viewDelivery($runner_ID){
        $tracking = new manageTrackingAndAnalyticModel();
        $tracking->runner_ID = $runner_ID;
        return $tracking->viewDelivery();
    }
}
?>