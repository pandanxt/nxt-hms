<?php 
  // Session Starts
  session_start(); 
  $id = (isset($_GET['id']) ? $_GET['id'] : '');
  if (isset($_SESSION['uuid'])) {
  include('backend_components/connection.php');
  // File Header
  include('components/file_header.php');
  include('components/navbar.php');
  include('components/sidebar.php');

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active">
                      <div class="card card-primary card-outline">
                      <?php
                        $patientQuery="SELECT *,`USER_NAME` FROM `me_patient` INNER JOIN `me_user` WHERE `PATIENT_MR_ID` = '".$_GET['id']."' AND `me_patient`.`STAFF_ID` = `me_user`.`USER_UUID`";     
                        $patientSql = mysqli_query($db,$patientQuery) or die (mysqli_error($db));
                        $row = mysqli_fetch_array($patientSql)
                      ?>
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="fas fa-user"></i>&nbsp;
                            <?php 
                              echo "$row[PATIENT_NAME] Medical History"; 
                              if ($row['PATIENT_DELETE'] == 0) {
                                echo "&nbsp;<button class='btn badge badge-danger'>Patient Deleted</button>";
                              }
                            ?>
                          </h3>
                        </div>
                        <div class="card-body">
                          <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="col-md-12 clearfix">
                                <?php echo '<div class="row"><label>MR ID: </label>&nbsp; <p>'.$row["PATIENT_MR_ID"].'</p></div>'; ?>
                                <?php echo '<div class="row"><label>Mobile: </label>&nbsp; <p>'.$row["PATIENT_MOBILE"].'</p></div>'; ?>
                                <?php echo '<div class="row"><label>Age: </label>&nbsp; <p>'.$row["PATIENT_AGE"].'&nbsp;Years - '.$row["PATIENT_GENDER"].'</p></div>'; ?>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="col-md-12 clearfix">
                                  <?php echo '<div class="row"><label>Address: </label>&nbsp; <p>'.$row["PATIENT_ADDRESS"].'</p></div>'; ?>
                                  <?php echo '<div class="row "><label>Date: </label>&nbsp; <p>'.$row["PATIENT_DATE_TIME"].'</p></div>'; ?>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="col-md-12 clearfix">
                                  <?php 
                                      echo "<div class='row'><label>Created By: </label>&nbsp; <p>$row[USER_NAME]</p></div> 
                                        <div class='row'><label>Options: </label>&nbsp; 
                                      <p>&nbsp;
                                      <a href='javascript:void(0)' onclick='getPatientId(this);' data-mrid='$row[PATIENT_MR_ID]' data-name='$row[PATIENT_NAME]' data-mobile='$row[PATIENT_MOBILE]' data-toggle='modal' data-target='#patient-slip'>
                                        <i class='fas fa-plus'></i> Slip
                                      </a>
                                      &nbsp;
                                      <a href='javascript:void(0)' onclick='editPatientId(this);' data-mrid='$row[PATIENT_MR_ID]' data-toggle='modal' data-target='#edit-patient'>
                                        <i class='fas fa-edit'></i> Edit
                                      </a>";
                                      if ($row['PATIENT_DELETE'] != 0) {
                                        echo "&nbsp;<a onClick='softDeletePatient(this)' data-mrid='$row[PATIENT_MR_ID]' href='javascript:void(0);' style='color:red;'>
                                          <i class='fas fa-trash'></i> Soft Delete
                                        </a>";
                                      }
                                      if ($_SESSION['role'] == "admin") { 
                                        echo "&nbsp;<a onClick='deletePatient(this)' data-mrid='$row[PATIENT_MR_ID]' href='javascript:void(0);' style='color:red;'>
                                          <i class='fas fa-trash'></i> Hard Delete
                                        </a>";
                                      }
                                      echo '</p></div>'; 
                                  ?>    
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                  <thead>
                                  <tr style="font-size: 14px;">
                                    <th>Id</th>
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
                                      $recordQuery ="SELECT *,`USER_NAME`,`DOCTOR_NAME`,`DOCTOR_TYPE` FROM `me_slip` 
                                      INNER JOIN `me_user` INNER JOIN `me_doctors`
                                      WHERE `SLIP_MRID` = '".$_GET['id']."' 
                                      AND `me_user`.`USER_UUID` = `me_slip`.`STAFF_ID`
                                      AND `me_doctors`.`DOCTOR_UUID` = `me_slip`.`SLIP_DOCTOR`
                                      AND `SLIP_DELETE` != 0";
                                    } else {
                                      $recordQuery ="SELECT *,`USER_NAME`,`DOCTOR_NAME`,`DOCTOR_TYPE` FROM `me_slip` 
                                      INNER JOIN `me_user` INNER JOIN `me_doctors`
                                      WHERE `SLIP_MRID` = '".$_GET['id']."' 
                                      AND `me_user`.`USER_UUID` = `me_slip`.`STAFF_ID`
                                      AND `me_doctors`.`DOCTOR_UUID` = `me_slip`.`SLIP_DOCTOR`";
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
                  </div>
                </div>
              </div>
            </div>
        <?php //} ?>
          </section>
        </div>
  <!-- Javascript Script File -->
  <script src="dist/js/patient_script.js"></script>        
  <!-- /.Footer -->
<?php
  // Footer File
  include_once('components/footer.php');
  echo '</div>';
  // REQUIRED SCRIPTS 
  include('components/file_footer.php');
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>