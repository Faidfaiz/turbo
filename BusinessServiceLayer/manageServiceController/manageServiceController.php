<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageServiceModel//manageServiceModel.php';

class manageServiceController{
    
    //To allow the service provider to add new service to the system 
    function addService(){
        $service = new manageServiceModel();
        $service->sp_ID = $_SESSION['sp_ID'];
        $service->product_category = $_POST['product_category'];
        $service->product_name = $_POST['product_name'];
        $service->product_image = $_FILES['product_image']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);      
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
          // Convert to base64 
          $image_base64 = base64_encode(file_get_contents($_FILES['product_image']['tmp_name']) );
          $service->product_image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
        }
        $service->product_details = $_POST['product_details'];
        $service->product_unit_price = $_POST['product_unit_price'];
        if($service->addService()){
            $message = "Service Add SUCCESSFULLY!";
		echo "<script type='text/javascript'>alert('$message');
		window.location = '/sdw/ApplicationLayer/manageServiceView/spHomePage.php?sp_ID=".$_SESSION['sp_ID']."';</script>";
        }
    }

    //To show all the service provider product that stored in the system
    function viewService($sp_ID){
        $service = new manageServiceModel();
        $service->sp_ID = $_SESSION['sp_ID'];
        return $service->viewAllService();
    }

   //To show all the Detail for the specific product
    function viewServiceDetails($service_ID){
        $service = new manageServiceModel();
        $service->service_ID = $service_ID;
        return $service->viewServiceDetails();
    }

    //To update the information for teh specific product
    function editServiceDetails($service_ID){
        $service = new manageServiceModel();
        $service->sp_ID = $_SESSION['sp_ID'];
        $service->service_ID = $service_ID;
        $service->product_name = $_POST['product_name'];
        $service->product_details = $_POST['product_details'];
        $service->product_unit_price = $_POST['product_unit_price'];
        if($service->editServiceDetails()){
            echo "<script type='text/javascript'>alert('Your service are success Update!!!');
            window.location = '/sdw/ApplicationLayer/manageServiceView/spHomePage.php?sp_ID=".$_SESSION['sp_ID']."';</script>";
        }
        else
            echo "<script type='text/javascript'>alert('Your service are failed Update!!!');
            window.location = '/sdw/ApplicationLayer/manageServiceView/spHomePage.php?sp_ID=".$_SESSION['sp_ID']."';</script>";
    }

    //To Delete a specific product  from the system 
    function deleteService($service_ID){
        $service = new manageServiceModel();
        $service->service_ID = $service_ID;
        if($service->deleteService()){
            echo "<script type='text/javascript'>alert('Your service are success Deleted!!!');
            window.location = '/sdw/ApplicationLayer/manageServiceView/spHomePage.php?sp_ID=".$_SESSION['sp_ID']."';</script>";
        }
        else
            echo "<script type='text/javascript'>alert('Your service are failed Delete!!!');
            window.location = '/sdw/ApplicationLayer/manageServiceView/viewServiceDetails.php?sp_ID=".$_SESSION['sp_ID']."';</script>";
        return $service->deleteService();
    }
}
?>
