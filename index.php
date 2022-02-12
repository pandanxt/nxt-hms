<?php 
  session_start();
  if (isset($_SESSION['userid'])) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MedEast | Healthcare</title>
  <link rel="icon" type="image/png" href="dist/img/medeast-logo-icon.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Connection -->
  <?php include('backend_components/connection.php'); ?>

  <!-- Navbar -->
  <?php include('components/navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('components/sidebar.php'); ?>
  <!-- /.Main Sidebar Container-->

  <!-- Content Wrapper. Contains page content -->
  <?php include('components/mainbody.php');?>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('components/footer.php'); ?>
  <!-- /. Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script>  
  const urlParams = new URLSearchParams(window.location.search);
  var action = urlParams.get('login');
  // var action = urlParams.get('action');

  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    if (action == "success") {
      Toast.fire({
        icon: 'success',
        title: 'Logged In Successfully!'
      })
    }    
    if (action == "sqlerror") {
      Toast.fire({
        icon: 'error',
        title: 'Something Went Wrong. Try Again!'
      })
    }
  });
</script>
</body>
</html>

<?php 
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>
