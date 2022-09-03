<?php 
    // Session Starts
    session_start();
    if (isset($_SESSION['uuid'])) {
    // Get Type from URL
    $type = (isset($_GET['type']) ? $_GET['type'] : '');
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
          <div class="col-sm-2"><a type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-indoor"><i class="fas fa-plus"></i> New Patient</a></div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Patients</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Table Data of Patient -->
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
                    <th>MR-ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Doctor</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    if ($type != 'all') {
                        $sql ="SELECT *,`DOCTOR_NAME`,`ADMIN_USERNAME` FROM `indoor_patient` INNER JOIN `admin` INNER JOIN `doctor` WHERE `indoor_patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` AND `indoor_patient`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `indoor_patient`.`INDOOR_TYPE` = '$type'";
                    }else{
                        $sql ="SELECT *,`DOCTOR_NAME`,`ADMIN_USERNAME` FROM `indoor_patient` INNER JOIN `admin` INNER JOIN `doctor` WHERE `indoor_patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` AND `indoor_patient`.`STAFF_ID` = `admin`.`ADMIN_ID`";    
                    }
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                       $date = substr($rs['PATIENT_DATE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[PATIENT_ID]
                           <br> <a href='add_bill.php?id=$rs[PATIENT_ID]' style='color:green;'>
                              <i class='fas fa-wallet'></i> Bill
                            </a>
                        </td>
                        <td>$rs[PATIENT_MR_ID]</td>
                        <td>$rs[PATIENT_NAME]</td>
                        <td>$rs[PATIENT_MOBILE]</td>
                        <td>$rs[PATIENT_GENDER]</td>
                        <td>$rs[PATIENT_AGE]</td>
                        <td>$rs[PATIENT_ADDRESS]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>$rs[ADMIN_USERNAME]</td>
                        <td>$date</td> 
                        <td style='display:flex;'>
                            <a href='view_patient.php?id=$rs[PATIENT_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a><br>
                            <a href='add_patient.php?id=$rs[PATIENT_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?patId=$rs[PATIENT_ID]' style='color:red;'>
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