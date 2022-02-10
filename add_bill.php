<?php 
  session_start(); 
  $type = (isset($_GET['type']) ? $_GET['type'] : ''); 
?>
<!-- Header Form -->
  <?php include('backend_components/connection.php'); ?>
  <!-- Header Files -->
  <?php include('components/form_header.php'); ?>
  <!-- Navbar -->
  <?php include('components/navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('components/sidebar.php'); ?>
  <!-- /.Main Sidebar Container-->

  <!-- Content Wrapper. Contains page content -->
  <?php 
    if (empty($_GET['id']) && $_GET['type']) {
      include('components/simple_bill_form.php');  
      // echo '<script>alert("This is simplet bill form");</script>';
    } else {
      include('components/bill_form.php');
      // echo '<script>alert("This is bill form");</script>';
    }  
  ?>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('components/footer.php'); ?>
  <!-- /. Main Footer -->
</div>
<!-- ./wrapper -->

<!-- Script Files -->
<?php include('components/form_script.php'); ?>