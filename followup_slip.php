<?php 
  // Session Start
  session_start(); 
  if (isset($_SESSION['uuid'])) {
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
            </div>
        </div><!-- /.container-fluid -->
    </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr style="font-size: 14px;">
                      <th>Patient Details</th>
                      <th>Doctor</th>
                      <th>FollowUp Fee</th>
                      <th>Created</th>
                      <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $recordQuery ="SELECT `a`.*,`b`.`SLIP_MRID`,`b`.`SLIP_NAME`,`b`.`SLIP_MOBILE`,`b`.`SLIP_TYPE`,`b`.`SLIP_SUB_TYPE`,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`,`d`.`DOCTOR_TYPE` FROM `me_followup_slip` AS `a` 
                        INNER JOIN `me_slip` AS `b` ON `b`.`SLIP_UUID` = `a`.`SLIP_REFERENCE_UUID`
                        INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID`
                        INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `b`.`SLIP_DOCTOR`";
                        $sql = mysqli_query($db,$recordQuery);
                        while($slip_row = mysqli_fetch_array($sql))
                        { 
                          echo "<tr style='font-size: 12px;'>
                          <td>
                                <b>MRID</b>: $slip_row[SLIP_MRID] <br>
                                <b>Name</b>: $slip_row[SLIP_NAME] <br>
                                <b>Mobile</b>: $slip_row[SLIP_MOBILE]
                          </td>
                          
                          <td>$slip_row[DOCTOR_NAME]&nbsp;
                            <button class='btn badge badge-info'>$slip_row[DOCTOR_TYPE] doctor</button>
                          </td>
                          <td>";
                            if ($slip_row['SLIP_FEE'] != 0) {
                                echo $slip_row['SLIP_FEE'];
                            }else {
                                echo 'Free';
                            }
                          echo "&nbsp;
                          <button class='btn badge badge-info'>$slip_row[SLIP_TYPE]</button>
                          </td>
                          <td>
                              <b>By</b>: $slip_row[USER_NAME] <br>
                              <b>On</b>: $slip_row[SLIP_DATE_TIME]
                          </td> 
                          <td style='display:flex;'>
                              <a href='javascript:void(0)' onclick='printMiniSlipRecord(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='FOLLOWUP_SLIP' style='color:green;'>
                                <i class='fas fa-wallet'></i> Slip Print
                              </a>";
                              if ($_SESSION['role'] == "admin") { 
                              echo "<br>
                              <a onClick='deleteFollowSlip(this)' data-uuid='$slip_row[SLIP_UUID]' href='javascript:void(0);' style='color:red;'>
                                <i class='fas fa-trash'></i> Delete Slip
                              </a>";
                              }
                          echo "</td>
                          </tr>"; 
                        }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>
  <!-- Javascript Script File -->
 <script src="dist/js/slip_script.js"></script>
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