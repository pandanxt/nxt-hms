<?php 
  // Session Start
  session_start();
  if (isset($_SESSION['userid'])) {
  // Connection File
  include('backend_components/connection.php');
  // Table Header File
  include('components/table_header.php');
  // Navbar File
  include('components/navbar.php'); 
  // Sidebar File
  include('components/sidebar.php'); 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2"><a type="submit" class="btn btn-block btn-primary btn-sm" href="add_doctor.php"><i class="fas fa-plus"></i> New Doctor</a></div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Doctors</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Doctor Table Data -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr style='font-size: 14px;'>
                    <th>S.No#</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`DEPARTMENT_NAME`, `ADMIN_USERNAME` FROM `doctor` INNER JOIN `admin` INNER JOIN `department` WHERE `doctor`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `doctor`.`DEPARTMENT_ID` = `department`.`DEPARTMENT_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        $date = substr($rs['DOCTOR_DATE_TIME'],0, 21);
                        echo "<tr style='font-size: 12px;'>
                        <td>$rs[DOCTOR_ID]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>$rs[DEPARTMENT_NAME]</td>
                        <td>$rs[DOCTOR_STATUS]</td>
                        <td>
                            <b>By</b>: $rs[ADMIN_USERNAME] <br>
                            <b>On</b>: ".$date."
                        </td>
                        <td style='display:flex;'>
                            <a href='view_doctor.php?id=$rs[DOCTOR_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='add_doctor.php?id=$rs[DOCTOR_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?docId=$rs[DOCTOR_ID]' style='color:red;'>
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
<?php 
  // Footer File
  include ('components/footer.php'); 
  echo '</div>';
  // Table Script File
  include('components/table_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>