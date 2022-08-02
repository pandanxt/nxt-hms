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
                  <tr style="font-size: 14px;">
                    <th>S.No#</th>
                    <th>MR-ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Medical Officer</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`ADMIN_USERNAME` FROM `emergency_slip` INNER JOIN `admin` WHERE `emergency_slip`.`STAFF_ID` = `admin`.`ADMIN_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr  style='font-size: 12px;'>
                        <td>$rs[SLIP_ID]</td>
                        <td>$rs[SLIP_MR_ID]</td>
                        <td>$rs[SLIP_NAME]</td>
                        <td>$rs[SLIP_MOBILE]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>$rs[ADMIN_USERNAME]</td>
                        <td>$rs[SLIP_DATE_TIME]</td> 
                        <td style='display:flex;'>";
                          if($rs['BILL_STATUS'] == "pending"){
                            echo "<a href='emergency_patient_bill.php?sid=$rs[SLIP_ID]' style='color:green;'>
                              <i class='fas fa-wallet'></i> Bill</a>
                              <br> 
                              <a href='javascript:void(0)' onclick='printSlip($rs[SLIP_ID]);' style='color:green;'>
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
                            echo "<a href='javascript:void(0)' onclick='printSlip($rs[SLIP_ID]);' style='color:green;'>
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
                <script>
                  function printSlip(sid) {
                    window.open(`print-page.php?type=imrc&sid=${sid}`, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=600,height=500");
                   }               
                </script>
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