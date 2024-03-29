<?php 
  // Session Start
  session_start(); 
  if (isset($_SESSION['uuid'])) {
  // Connection File
  include('backend_components/connection.php');
  // File Header
  include('components/file_header.php'); 
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
          <div class="col-sm-2">
            <a type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#add-patient">
              <i class="fas fa-plus"></i> NEW PATIENT
            </a>
          </div>
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
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr style="font-size: 14px;">
                    <th>MR-ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`USER_NAME` FROM `me_patient` INNER JOIN `me_user` WHERE `me_patient`.`STAFF_ID` = `me_user`.`USER_UUID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr style='font-size: 12px;'>
                        <td>
                          $rs[PATIENT_MR_ID]
                          <br><a href='javascript:void(0)' onclick='getPatientId(this);' data-mrid='$rs[PATIENT_MR_ID]' data-name='$rs[PATIENT_NAME]' data-mobile='$rs[PATIENT_MOBILE]' data-toggle='modal' data-target='#patient-slip'>
                            <i class='fas fa-plus'></i> Slip
                          </a>
                        </td>
                        <td>$rs[PATIENT_NAME]";
                        if ($rs['PATIENT_DELETE'] == 0) {
                          echo "&nbsp;<button class='btn badge badge-danger'>Patient Deleted</button>";
                        }
                        echo "</td>
                        <td>$rs[PATIENT_MOBILE]</td>
                        <td>$rs[PATIENT_GENDER]</td>
                        <td>$rs[PATIENT_AGE]</td>
                        <td>$rs[PATIENT_ADDRESS]</td>
                        <td>
                            <b>By</b>: $rs[USER_NAME] <br>
                            <b>On</b>: $rs[PATIENT_DATE_TIME]
                        </td> 
                        <td style='display:flex;'>
                            <a href='view_patient.php?id=$rs[PATIENT_MR_ID]' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a>
                            <br><a href='javascript:void(0)' onclick='editPatientId(this);' data-mrid='$rs[PATIENT_MR_ID]' data-toggle='modal' data-target='#edit-patient'>
                              <i class='fas fa-edit'></i> Edit
                            </a>";
                            if ($rs['PATIENT_DELETE'] != 0) {
                              echo "<br><a onClick='softDeletePatient(this)' data-mrid='$rs[PATIENT_MR_ID]' href='javascript:void(0);' style='color:red;'>
                                <i class='fas fa-trash'></i> Soft Delete
                              </a>";
                            }
                            if ($_SESSION['role'] == "admin") { 
                              echo "<br>
                              <a onClick='deletePatient(this)' data-mrid='$rs[PATIENT_MR_ID]' href='javascript:void(0);' style='color:red;'>
                                <i class='fas fa-trash'></i> Hard Delete
                              </a>";
                            }
                        echo "</td>
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
  <!-- Javascript Script File -->
  <script src="dist/js/patient_script.js"></script>
<?php 
  // Footer File
  include ('components/footer.php'); 
  echo '</div>';
  // REQUIRED SCRIPTS 
  include('components/file_footer.php');
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>