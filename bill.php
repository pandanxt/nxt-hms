  <!-- Connection -->
  <?php include('backend_components/connection.php'); ?>

  <!-- table-header -->
  <?php include('components/table_header.php'); ?>
   <!-- Navbar -->
   <?php include('components/navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('components/sidebar.php'); ?>
  <!-- /.Main Sidebar Container-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- <div class="col-sm-2">
            <h1>Patient Bills</h1>
          </div> -->
          <div class="col-sm-2"><a type="submit" class="btn btn-block btn-primary btn-sm" href="add_bill.php"><i class="fas fa-plus"></i> New Bill</a></div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Patient Bills</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <?php include('components/bill_table.php'); ?>
    <!-- /.content -->
  </div>
  <!-- /.Footer -->
  <?php include ('components/footer.php'); ?>
  <!-- /.Footer -->
</div>
<!-- ./wrapper -->

<!-- Table Script -->
<?php include('components/table_script.php'); ?>