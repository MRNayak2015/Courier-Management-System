<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
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
        .double-lines {
            position: relative;
        }

        .double-lines::before,
        .double-lines::after {
            content: "";
            position: absolute;
            left: 0;
            width: 100%;
            border-top: 2px solid #000; /* Adjust the color and thickness as needed */
        }

        .double-lines::before {
            top: -10px; /* Adjust the distance above the sentence */
        }

        .double-lines::after {
            bottom: -10px; /* Adjust the distance below the sentence */
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
      font-size: 80px;
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
<marquee direction="left" behavior="alternate" scrollamount=3 >
   <h2 style="color:orange"><b>Efficiency in Motion, Excellence in Delivery: Your Trusted Courier Management Partner</b></h2>
</marquee>
<div class="double-lines">
    <h1 class="animate-charcter"<strong>VelocityCargo Couriers</strong></h1>
    <h2 class="speaker-icon" style="display: inline-block; margin-left: 10px; cursor: pointer; font-size: 30px;" onclick="speakName()">🔊</h2>
</div>

<div class="login-box">
  <div class="login-logo">
  <a href="#" style="color:Black;"><b><?php echo $_SESSION['system']['name'] ?> - Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form action="" id="login-form">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
            <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
              <p class = "text-left"> Forgot Password ? <a href="recover_email.php">click here</a></p>
            </div>
          </div>
      </div>
          <!-- /.col -->
          <div class="row">
          <div class="col-8">
  <a href="user_track.php" class="btn btn-sm btn-primary btn-gradient-primary">
    Track
    <span class="fas fa-search"></span>
  </a>
</div>
          <div class="col-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary btn-gradient-primary">Sign In</button>
          </div>
          <!-- /.col -->
          
      </div>
        </div>
      </form>
    </div>
      </div>
    <!-- /.login-card-body -->
  </div>
<!-- /.login-box -->
<script>
  function speakName() {
  var utterance = new SpeechSynthesisUtterance('Velocity Cargo Couriers');
  speechSynthesis.speak(utterance);
}
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          alert("आपका स्वागत हैं 🙏");
          location.href ='index.php?page=home';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          end_load();
        }
      }
    })
  })
  })
</script>

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
