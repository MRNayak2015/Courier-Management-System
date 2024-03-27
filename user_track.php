<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="images/logo3.png">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/styles.css">
  <style>
    body {
      background-image: url('images/animation2.gif');
      background-repeat: no-repeat;
      background-size: cover;
    }

    .my_box {
      margin-top: 100px; /* Adjust the value as needed */
    }
  </style>
</head>
<?php include 'header.php' ?>
<body class="hold-transition login-page d-flex align-items-center justify-content-center">
  <div class="my_box">
    <div class="card-body login-card-body">
      <form action="" id="login-form">
        <div class="input-group mb-3">
          <input type="number" id="ref_no" class="form-control form-control-sm" placeholder="Type the tracking number here" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-search"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3">
            <button type="button" id="track-btn" class="btn btn-sm btn-primary btn-gradient-primary">
              Track
              <span class="fa fa-search"></span>
            </button>
          </div>
          <div class="col-5 d-flex justify-content-center">
            <button type="reset" id="btnReset" class="btn btn-sm btn-primary btn-gradient-primary" disabled>
              Reset
              <span class="fa fa-sync-alt"></span>
            </button>
          </div>
          <div class="col-4 d-flex justify-content-end">
            <a href="login.php" class="btn btn-sm btn-primary btn-gradient-primary">Login</a>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="timeline" id="parcel_history"></div>
        </div>
      </div>

      <div id="clone_timeline-item" class="d-none">
        <div class="iitem">
          <i class="fas fa-box bg-blue"></i>
          <div class="timeline-item">
            <span class="time"><i class="fas fa-clock"></i> <span class="dtime">12:05</span></span>
            <div class="timeline-body">
              asdasd
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      function track_now() {
        start_load();
        var tracking_num = $('#ref_no').val();
        if (tracking_num == '') {
          $('#parcel_history').html('');
          end_load();
        } else {
          $('#ref_no, #track-btn, #btnReset').prop('disabled', true); // Disable fields and buttons
          $.ajax({
            url: 'ajax.php?action=get_parcel_heistory',
            method: 'POST',
            data: { ref_no: tracking_num },
            error: err => {
              console.log(err);
              alert_toast("An error occurred", 'error');
              end_load();
            },
            success: function (resp) {
              if (typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object') {
                resp = JSON.parse(resp);
                if (Object.keys(resp).length > 0) {
                  $('#parcel_history').html('');
                  Object.keys(resp).map(function (k) {
                    var tl = $('#clone_timeline-item .iitem').clone();
                    tl.find('.dtime').text(resp[k].date_created);
                    tl.find('.timeline-body').text(resp[k].status);
                    $('#parcel_history').append(tl);
                  });
                }
              } else if (resp == 2) {
                alert_toast('Unknown Tracking Number.', 'error');
              }
            },
            complete: function () {
              end_load();
              $('#ref_no, #track-btn').prop('disabled', true); 
			  $('#btnReset').prop('disabled', false);// Enable fields and buttons
            }
          });
        }
      }

      $('#track-btn').click(function () {
        track_now();
      });

      $('#ref_no').on('search', function () {
        track_now();
        $('#btnReset').prop('disabled', false); // Enable reset button when searching
      });

      $('#btnReset').click(function () {
        $('#ref_no').val('');
        $('#track-btn').prop('disabled', false);
		$('#ref_no').prop('disabled', false);
        $('#btnReset').prop('disabled', true); // Disable reset button when clicked
      });
    </script>

    <?php include 'footer.php' ?>

    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <p>
      <!-- for space from form body -->
    </p>
    <footer class="left-footer">
      <strong>Copyright &copy; 2024 <a href="https://github.com/Pranab-0312" target="_blank">Developer</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b><?php echo $_SESSION['system']['name'] ?></b>
      </div>
    </footer>
  </div>
</body>
</html>
