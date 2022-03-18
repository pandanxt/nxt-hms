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
            <h1>Patients</h1>
          </div> -->
          <div class="col-sm-2"><a type="submit" class="btn btn-block btn-primary btn-sm" href="emergency.php"><i class="fas fa-plus"></i> New Patient</a></div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Patients</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <?php //include('components/patient_table.php'); ?>
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
                    <!-- <th>Type</th> -->
                    <th>Mobile</th>
                    <!-- <th>CNIC</th> -->
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Doctor</th>
                    <!-- <th>Patient Bill</th> -->
                    <th>Created By</th>
                    <!-- <th>Discharge</th> -->
                    <th>Created On</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`DOCTOR_NAME`,`ADMIN_USERNAME` FROM `emergency_patient` INNER JOIN `admin` INNER JOIN `doctor` WHERE `emergency_patient`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` AND `emergency_patient`.`STAFF_ID` = `admin`.`ADMIN_ID`";
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
  <?php include ('components/footer.php'); ?>
  <!-- /.Footer -->
</div>
<!-- ./wrapper -->
<!-- Table Script -->
<?php include('components/table_script.php'); ?>