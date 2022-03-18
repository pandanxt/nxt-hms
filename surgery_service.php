<?php session_start(); ?>
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
            <h1>Services</h1>
          </div> -->
          <div class="col-sm-2"><a type="submit" class="btn btn-block btn-primary btn-sm" href="add_surgery_service.php"><i class="fas fa-plus"></i> New Service</a></div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Surgery Services</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <?php //include('components/service_table.php'); ?>

    <!-- Service Table with data -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No#</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`ADMIN_USERNAME` FROM `surgery_service` INNER JOIN `admin` WHERE `surgery_service`.`STAFF_ID` = `admin`.`ADMIN_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        $date = substr($rs['SERVICE_DATE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[SERVICE_ID]</td>
                        <td>$rs[SERVICE_NAME]</td>
                        <td>$rs[SERVICE_STATUS]</td>
                        <td>$rs[ADMIN_USERNAME]</td>
                        <td>$date</td>
                        <td style='display:flex;'>
                            <a href='view_service.php?id=$rs[SERVICE_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='add_service.php?id=$rs[SERVICE_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?serId=$rs[SERVICE_ID]' style='color:red;'>
                              <i class='fas fa-trash'></i> Delete
                            </a>
                        </td>
                        </tr>"; 
                      }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.Footer -->
  <?php include ('components/footer.php'); ?>
  <!-- /.Footer -->
</div>
<!-- ./wrapper -->
<!-- Table Script -->
<?php include('components/table_script.php'); ?>