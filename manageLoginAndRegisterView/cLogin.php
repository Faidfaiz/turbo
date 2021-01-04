<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/sdw/BusinessServiceLayer/manageLoginAndRegisterController/manageLoginAndRegisterController.php';

$cust = new manageLoginAndRegisterController();asdsad
if (isset($_POST['login'])) {
    $cust->cLogin();
}

if (isset($_POST['register'])) {
    $cust->cReg();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <title>Login Page | Customer - Turbo Runner Delivery Service</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <script>
      function showPassword() {
        var x = document.getElementById("password");
    
        if(x.type === "password"){
          x.type = "text";
        } 
        else{
          x.type = "password";
        }
      }
    </script>
    <style>
      .pwd {
        padding-top: 10px;
        text-align: left;
      }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Turbo Runner Delivery System</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.html"><span class="glyphicon glyphicon-share-alt"></span> Back</a></li>
      </ul>
    </div>
  </nav>    
    <div class="container">
      <div class="page-header">
        <h2>Sign In</h2>
      </div> 
      <form action="" method="POST">  
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input type="email" class="form-control" name="cust_email" placeholder="Email" autofocus required/>
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" name="cust_password" id="password" placeholder="Password" required/>
          </div>
          <div class="pwd"><input type="checkbox" onclick="showPassword()">&nbsp;Show Password</div>
          <br>
          <div class="btn-group">
            <button type="submit" name="login" class="btn btn-primary">Login</button>
          </div>
          <p>You have no an account?<a href="#regModal" data-toggle="modal" data-target="#regModal">Register</a> Here</p>
          <p>Forgot your password?<a href="enter_email.php">Reset password</a> Here</p>
        </div>
      </form>
    </div>

    <!-- Modal -->
    <form action="" method="POST">
      <div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="regModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Register Form | Customer</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input type="text" class="form-control" name="cust_name" placeholder="Name" autofocus required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                  <input type="number" class="form-control" name="cust_phone" placeholder="Phone Number" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                  <input type="text" class="form-control" name="cust_add1" placeholder="Address 1" required>
                  <input type="text" class="form-control" name="cust_add2" placeholder="Address 2" required>
                  <input type="number" class="form-control" name="cust_postal_code" placeholder="Postal Code" required>
                  <input type="text" class="form-control" name="cust_city" placeholder="City" required>
                  <input type="text" class="form-control" name="cust_state" placeholder="State" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input type="email" class="form-control" name="cust_email" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group col-xs-15">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input type="password" class="form-control" name="cust_password" placeholder="Password" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="register" class="btn btn-primary">Register</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
