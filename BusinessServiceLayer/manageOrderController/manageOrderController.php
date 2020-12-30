<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageOrderModel/manageOrderModel.php';

class manageOrderController{
    
    //This function is to retrive all the service and its information in customer home page
    function viewProduct() {
        $service = new manageOrderModel();
        return $service->viewAllProduct();
    }

    //This function is to retrive the information based on the product category from the service table 
    function viewProductList($product_category) {
        $service = new manageOrderModel();
        $service->product_category = $product_category;
        return $service->viewProductList();
    }

    //This function is to retrive the full information for the choosen product by comparing the service ID 
    function viewProductDetails($service_ID){
        $service = new manageOrderModel();
        $service->service_ID = $service_ID;
        return $service->viewProductDetails();
    }

    //This function is to retrive the product that have the same name as the search word from the service table
    function searchProduct($search) {
        $service = new manageOrderModel();
        $service->search = $search;
        if ($service->searchProduct()) {
            $message ="Result(s) found!";
        }
        else {
            $message ="No result!";
        }
        echo "<script>alert('$message')</script>";
        return $service->searchProduct();
    }

    //This function is to insert the product information to the cart table
    function addToCart(){
        $service = new manageOrderModel();
        $service->cust_ID = $_SESSION['cust_ID'];
        $service->service_ID = $_GET['service_ID'];
        $service->quantity = $_POST['quantity'];
        $service->product_unit_price = $_POST['product_unit_price'];
        if($service->addToCart()){
            echo "<script>alert('Your product are success Add To Cart!');
            window.location = '/sdw/ApplicationLayer/manageOrderView/custHomePage.php?cust_ID=".$_SESSION['cust_ID']."';</script>";
        }
        else {
            echo "<script>alert('Your product are failed Add To Cart!');
            window.location = '/sdw/ApplicationLayer/manageOrderView/viewProductDetails.php?service_ID=".$_SESSION['service_ID']."';</script>";
        }
    }

    //This function is to retrive the cart information from the cart table 
    function viewCart() {
        $service = new manageOrderModel();
        $service->cust_ID = $_SESSION['cust_ID'];
        return $service->viewCart();
    }

    //This function is to update the quantity of product in cart
    function updateCart(){
        $service = new manageOrderModel();
        $service->cust_ID = $_SESSION['cust_ID'];
        $service->service_ID = $_POST['service_ID'];
        $service->quantity = $_POST['quantity'];
        if($service->updateCart()){
            $message = "The product are update successfully!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = '/sdw/ApplicationLayer/manageOrderView/cart.php?cust_ID=".$_SESSION['cust_ID']."';</script>";
        }
    }

    //This function is to delete the product from cart
    function deleteCart() {
        $service = new manageOrderModel();
        $service->cust_ID = $_SESSION['cust_ID'];
        $service->service_ID = $_POST['service_ID'];
        if($service->deleteCart()){
            $message = "The product are removed from cart!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = '/sdw/ApplicationLayer/manageOrderView/cart.php?cust_ID=".$_SESSION['cust_ID']."';</script>";
        }
    }
}
?>
