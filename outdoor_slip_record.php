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
                    <th>MR-ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Consultant</th>
                    <th>Fee</th>
                    <th>Created</th>
                    <!-- <th>Created On</th> -->
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`ADMIN_USERNAME`,`DEPARTMENT_NAME` FROM `outdoor_slip` INNER JOIN `admin` INNER JOIN `department` WHERE `outdoor_slip`.`STAFF_ID` = `admin`.`ADMIN_ID` AND `outdoor_slip`.`DEPT_ID` = `department`.`DEPARTMENT_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                       $date = substr($rs['SLIP_DATE_TIME'],0, 21);
                        echo "<tr style='font-size: 12px;'>
                        <td>$rs[SLIP_MR_ID]</td>
                        <td>$rs[SLIP_NAME]</td>
                        <td>$rs[SLIP_MOBILE]</td>
                        <td>$rs[DEPARTMENT_NAME]</td>
                        <td>$rs[DOCTOR_NAME] <button class='btn badge badge-info'>";
                        if ($rs['D_TYPE'] == 1) echo "Visiting Doctor"; else echo "MedEast Doctor";
                        echo "</button></td>
                        <td>$rs[SLIP_FEE]</td>
                        <td>
                            <b>By</b>: $rs[ADMIN_USERNAME] <br>
                            <b>On</b>: ".$date."
                        </td> 
                        <td style='display:flex;'>
                              <a href='javascript:void(0)' onclick='printSlip($rs[SLIP_ID]);' style='color:green;'>
                              <i class='fas fa-wallet'></i> Print
                            </a>";
                            if ($_SESSION['type'] == "admin") {  
                            echo "<br>
                            <a href='add_patient.php?id=$rs[SLIP_ID]'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?osrId=$rs[SLIP_ID]' style='color:red;'>
                              <i class='fas fa-trash'></i> Delete
                            </a>";
                            }
                        echo "</td>
                        </tr>"; 
                      }
                  ?>
                  </tbody>
                </table>
                <script>
                  function printSlip(sid) {
                    window.open(`print-page.php?type=outdoor&sid=${sid}`, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=600,height=500");
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