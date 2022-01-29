  <!-- Header Form -->
  <?php include('backend_components/connection.php'); ?>
  <!-- Header Form -->
  <?php include('components/form_header.php'); ?>

  <!-- Navbar -->
  <?php include('components/navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('components/sidebar.php'); ?>
  <!-- /.Main Sidebar Container-->

  <!-- Content Wrapper. Contains page content -->
  <?php 
  if (empty($_GET['id'])) {
    include('components/patient_type_form.php');
  }else{
    include('backend_components/update_patient_type.php');
  }  
  ?>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include('components/footer.php'); ?>
  <!-- /. Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
  <?php include('components/form_script.php'); ?>