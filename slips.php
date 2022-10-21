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
            <div class="col-sm-2">
                <a type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-slip">
                  <i class="fas fa-plus"></i> NEW SLIP
                </a>
            </div>
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Slips</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

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
                      <th>Type</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Doctor</th>
                      <th>Created</th>
                      <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                      if ($_SESSION['role'] == "user") {
                        $recordQuery ="SELECT `a`.*,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`,`d`.`DOCTOR_TYPE` FROM `me_slip` AS `a` 
                        INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID`
                        INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `a`.`SLIP_DOCTOR`
                        WHERE `a`.`SLIP_DELETE` != 0";
                      }else {
                        $recordQuery ="SELECT `a`.*,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`,`d`.`DOCTOR_TYPE` FROM `me_slip` AS `a` 
                        INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID`
                        INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `a`.`SLIP_DOCTOR`";
                      }
                        
                        $sql = mysqli_query($db,$recordQuery);
                        while($slip_row = mysqli_fetch_array($sql))
                        { 
                          $slipTime = $slip_row['SLIP_DATE_TIME'];
                          $datetime1 = new DateTime($slipTime);
                          $datetime2 = new DateTime();
                          $difference = $datetime1->diff($datetime2);

                          echo "<tr style='font-size: 12px;'>
                          <td>$slip_row[SLIP_MRID]";
                            if ($difference->d <= 7) {
                                $followUp = "SELECT * FROM `me_followup_slip` WHERE `SLIP_REFERENCE_UUID` = ?";
                                $stmt = mysqli_stmt_init($db);
                                if (mysqli_stmt_prepare($stmt,$followUp)) {
                                  mysqli_stmt_bind_param($stmt,"s",$slip_row['SLIP_UUID']);
                                  mysqli_stmt_execute($stmt);
                                  mysqli_stmt_store_result($stmt);
                                  $resultCheck = mysqli_stmt_num_rows($stmt);
                                  if ($resultCheck == 0) {
                                    echo "<br><a href='javascript:void(0);' onclick='getSlipId(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-toggle='modal' data-target='#generate-followup'>
                                      <i class='fas fa-plus'></i> FollowUp Slip
                                    </a>";
                                  }
                                }
                              echo "<br><a href='javascript:void(0);' onclick='getSlipId(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-toggle='modal' data-target='#generate-service'>
                                <i class='fas fa-plus'></i> Service Slip
                              </a>";
                            }
                          echo "</td>
                          <td><b>$slip_row[SLIP_TYPE]</b>
                            <br><a href='javascript:void(0)' onclick='printSlipRecord(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' style='color:green;'>
                            <i class='fas fa-wallet'></i> Print Slip
                            </a>";
                            $showBill = "SELECT `BILL_UUID` FROM `me_bill` WHERE `BILL_SLIP_UUID` = '$slip_row[SLIP_UUID]'";
                            $billSql = mysqli_query($db, $showBill) or die (mysqli_error($db));
                            $bResult = mysqli_fetch_array($billSql);
                            if ($bResult > 0) {
                              if ($slip_row['SLIP_TYPE'] == 'INDOOR') {
                                echo "</br><a href='indoor_bill_print.php?sid=$bResult[BILL_UUID]' style='color:green;'>
                                <i class='fas fa-wallet'></i> Print Bill
                                </a>";
                              }else if ($slip_row['SLIP_TYPE'] == 'EMERGENCY') {
                                echo "</br><a href='emergency_bill_print.php?sid=$bResult[BILL_UUID]' style='color:green;'>
                                <i class='fas fa-wallet'></i> Print Bill
                                </a>";
                              }
                            }else {
                              if ($slip_row['SLIP_TYPE'] == 'INDOOR') {
                                echo "</br><a href='bills.php?type=$slip_row[SLIP_TYPE]&subtype=$slip_row[SLIP_SUB_TYPE]&sid=$slip_row[SLIP_UUID]'>
                                  <i class='fas fa-plus'></i> Create Bill
                                </a>";
                              }else if ($slip_row['SLIP_TYPE'] == 'EMERGENCY') {
                                echo "</br><a href='bills.php?type=$slip_row[SLIP_TYPE]&sid=$slip_row[SLIP_UUID]'>
                                  <i class='fas fa-plus'></i> Create Bill
                                </a>";
                              }
                            }
                          echo "</td>
                          <td>$slip_row[SLIP_NAME]";
                          if ($slip_row['SLIP_DELETE'] == 0) {
                            echo "&nbsp;<button class='btn badge badge-danger'>Slip Deleted</button>";
                          }
                          echo "</td>
                          <td>$slip_row[SLIP_MOBILE]</td>
                          <td>$slip_row[DOCTOR_NAME]&nbsp;
                            <button class='btn badge badge-info'>$slip_row[DOCTOR_TYPE] doctor</button>
                          </td>
                          <td>
                              <b>By</b>: $slip_row[USER_NAME] <br>
                              <b>On</b>: $slip_row[SLIP_DATE_TIME]
                          </td> 
                          <td style='display:flex;'>";
                            $chHistory = "SELECT `SLIP_ID` FROM `me_slip_history` WHERE `SLIP_UUID` = '$slip_row[SLIP_UUID]'";
                            $historySql = mysqli_query($db, $chHistory) or die (mysqli_error($db));
                            $hResult = mysqli_fetch_array($historySql);
                            if ($_SESSION['role'] == "admin" && $hResult > 0) {
                              echo "<a href='javascript:void(0);' onclick='viewHistory(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-subtype='$slip_row[SLIP_SUB_TYPE]' data-toggle='modal' data-target='#view-history'>
                                <i class='fas fa-sticky-note'></i> History
                              </a><br>";
                            }
                            echo "<a href='javascript:void(0);' onclick='editSlip(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-toggle='modal' data-target='#edit-slip'>
                              <i class='fas fa-edit'></i> Edit Slip
                            </a>";
                            if ($slip_row['SLIP_DELETE'] != 0) {
                              echo "<br><a onClick='softDeleteSlip(this)' data-uuid='$slip_row[SLIP_UUID]' href='javascript:void(0);' style='color:red;'>
                                <i class='fas fa-trash'></i> Soft Delete
                              </a>";
                            }
                          if ($_SESSION['role'] == "admin") { 
                            echo "<br>
                            <a onClick='deleteSlip(this)' data-uuid='$slip_row[SLIP_UUID]' href='javascript:void(0);' style='color:red;'>
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