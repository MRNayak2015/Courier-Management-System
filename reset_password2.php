<!DOCTYPE html>
<html lang="en">
<?php 
include('test2.php');
if(isset($_SESSION['test2'])){
    header("location: login.php"); //Redirecting
}
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
  
?>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="images/logo3.png">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<style>
        body {
            background-image: url('images/animation2.gif');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .animate-charcter
{
  background-image: linear-gradient(
    -225deg,
    #231557 0%,
    #44107a 29%,
    #ff1361 67%,
    #fff800 100%
  );
  background-size: auto auto;
  background-clip: border-box;
  background-size: 200% auto;
  color: #fff;
  background-clip: text;
  text-fill-color: transparent;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: textclip 2s linear infinite;
  display: inline-block;
      font-size: 50px;
}

@keyframes textclip {
  to {
    background-position: 200% center;
  }
}
    </style>
</head>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
<?php include 'header.php' ?>
<body class="hold-transition login-page">
<div>
<h1 class="animate-charcter" align='center' <strong>VelocityCargo Couriers</strong></h1>
      </div>
    
      <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">Recover Your Account</h1>
            <br>
            <p class="text-center">Please Enter Your Details Properly</p>
        </div>
    </div>
    
    <div class="card">
    <div class="card-body login-card-body">
    <form action="" method="POST">
                <div class ="panel panel-primary" style="margin-top: -2%; margin-bottom: 1%;">
                
                    <div class="panel-heading" style="background-color: #007bff; color: #fff; text-align: center"> Reset Password </div>
                    
                        
                <div class="row">
                            <div class="input-group mb-3">
                                <label for="firstname"><span class="text-danger" style="margin-right: 10px;"></span>  New Password </label>
                                <div class="input-group">
                                <input class="form-control"  type="password" name="new_password" value=""minlength="6" maxlength="16" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password Must contain at least one number and one uppercase and lowercase letter, and at least 6 characters." placeholder="New Password" required="">
    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <label for="lastname"><span class="text-danger" style="margin-right: 10px;"></span>  Confirm Password</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" name="confirm_password" value=""minlength="6" maxlength="16" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password Must contain at least one number and one uppercase and lowercase letter, and at least 6 characters." placeholder="Confirm Password" required="">
                  </div>
                            </div>
                        </div>
    <div class="row">
                            <div class="form-group col-xs-4">
                            <button class="btn btn-primary" name="submit" type="submit">Reset</button>
                            </div>
    </div>
                </form>
                </div>
            </div>               
    </div>
<?php include 'footer.php' ?>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  
  <footer class="left-footer">
    <strong>Copyright &copy; 2024 <a href="https://github.com/Pranab-0312" target="_blank">Developer</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b><?php echo $_SESSION['system']['name'] ?></b>
    </div>
  </footer>

</body>
</html>
