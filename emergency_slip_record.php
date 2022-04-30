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
    <section class="content-header"></section>

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
                    <th>Doctor</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`DOCTOR_NAME`,`ADMIN_USERNAME` FROM `emergency_slip` INNER JOIN `admin` INNER JOIN `doctor` WHERE `emergency_slip`.`DOCTOR_ID` = `doctor`.`DOCTOR_ID` AND `emergency_slip`.`STAFF_ID` = `admin`.`ADMIN_ID`";
                    //   $sql ="SELECT * FROM `emergency_slip`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                       $date = substr($rs['SLIP_DATE_TIME'],0, 21);
                        echo "<tr>
                        <td>$rs[SLIP_ID]</td>
                        <td>$rs[SLIP_MR_ID]</td>
                        <td>$rs[SLIP_NAME]</td>
                        <td>$rs[SLIP_MOBILE]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>$rs[ADMIN_USERNAME]</td>
                        <td>$date</td> 
                        <td style='display:flex;'>";
                          if($rs['BILL_STATUS'] == "pending"){
                            echo "<a href='emergency_patient_bill.php?sid=$rs[SLIP_ID]' style='color:green;'>
                              <i class='fas fa-wallet'></i> Bill</a>
                              <br> 
                              <a href='emergency_slip_print.php?sid=$rs[SLIP_ID]' style='color:green;'>
                              <i class='fas fa-wallet'></i> Print</a>";
                              if ($_SESSION['type'] == "admin") {  
                              echo "<br>
                              <a href='emergency_patient_slip.php?epsid=$rs[SLIP_ID]'><i class='fas fa-edit'></i> Edit</a>
                              <br>
                              <a onClick=\"javascript: return confirm('Please confirm deletion');\" 
                              href='backend_components/delete_handler.php?esrId=$rs[SLIP_ID]' style='color:red;'>
                              <i class='fas fa-trash'></i> Delete</a>";
                              }
                        }else{
                            echo "<a href='emergency_slip_print.php?sid=$rs[SLIP_ID]' style='color:green;'>
                            <i class='fas fa-wallet'></i> Print</a>";
                            if ($_SESSION['type'] == "admin") {  
                            echo "<br>
                            <a href='emergency_patient_slip.php?epsid=$rs[SLIP_ID]'><i class='fas fa-edit'></i> Edit</a>
                            <br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" 
                            href='backend_components/delete_handler.php?esrId=$rs[SLIP_ID]' style='color:red;'>
                            <i class='fas fa-trash'></i> Delete</a>";
                            }
                        }
                          
                        echo "</td></tr>"; 
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