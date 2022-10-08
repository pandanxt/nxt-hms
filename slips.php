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
                  <table id="example1" class="table table-bordered table-striped">
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
                        $recordQuery ="SELECT `a`.*,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`,`d`.`DOCTOR_TYPE` FROM `me_slip` AS `a` 
                        INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID`
                        INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `a`.`SLIP_DOCTOR`";
                        $sql = mysqli_query($db,$recordQuery);
                        while($slip_row = mysqli_fetch_array($sql))
                        { 
                          $slipTime = $slip_row['SLIP_DATE_TIME'];
                          $datetime1 = new DateTime($slipTime);
                          $datetime2 = new DateTime();
                          $difference = $datetime1->diff($datetime2);

                          echo "<tr style='font-size: 12px;'>
                          <td>$slip_row[SLIP_MRID]</td>
                          <td>$slip_row[SLIP_TYPE]</td>
                          <td>$slip_row[SLIP_NAME]</td>
                          <td>$slip_row[SLIP_MOBILE]</td>
                          <td>$slip_row[DOCTOR_NAME]&nbsp;
                            <button class='btn badge badge-info'>$slip_row[DOCTOR_TYPE] doctor</button>
                          </td>
                          <td>
                              <b>By</b>: $slip_row[USER_NAME] <br>
                              <b>On</b>: $slip_row[SLIP_DATE_TIME]
                          </td> 
                          <td style='display:flex;'>
                              <a href='javascript:void(0)' onclick='printSlipRecord(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' style='color:green;'>
                                <i class='fas fa-wallet'></i> Slip Print
                              </a>";
                                if ($difference->d <= 7) {
                                    $followUp = "SELECT * FROM `me_followup_slip` WHERE `SLIP_REFERENCE_UUID` = ?";
                                    $stmt = mysqli_stmt_init($db);
                                    if (mysqli_stmt_prepare($stmt,$followUp)) {
                                      mysqli_stmt_bind_param($stmt,"s",$slip_row['SLIP_UUID']);
                                      mysqli_stmt_execute($stmt);
                                      mysqli_stmt_store_result($stmt);
                                      $resultCheck = mysqli_stmt_num_rows($stmt);
                                      if ($resultCheck == 0) {
                                        echo "<br>
                                        <a href='javascript:void(0);' onclick='getSlipId(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-toggle='modal' data-target='#generate-followup'>
                                          <i class='fas fa-wallet'></i> FollowUp Slip
                                        </a>";
                                      }
                                    }
                                  echo "<br><a href='javascript:void(0);' onclick='getSlipId(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-toggle='modal' data-target='#generate-service'>
                                    <i class='fas fa-wallet'></i> Service Slip
                                  </a>";
                                }
                                if($slip_row['SLIP_TYPE'] != "OUTDOOR" && $slip_row['SLIP_STATUS'] != 0) {
                                  if($slip_row['SLIP_SUB_TYPE'] != NULL) {
                                    echo "</br>
                                    <a href='bills.php?type=$slip_row[SLIP_TYPE]&subtype=$slip_row[SLIP_SUB_TYPE]&sid=$slip_row[SLIP_UUID]'>
                                      <i class='fas fa-wallet'></i> Generate Bill
                                    </a>";
                                  }else {
                                    echo "</br>
                                    <a href='bills.php?type=$slip_row[SLIP_TYPE]&sid=$slip_row[SLIP_UUID]'>
                                      <i class='fas fa-wallet'></i> Generate Bill
                                    </a>";
                                  }  
                                }
                                  if ($_SESSION['role'] == "user") {
                                    $request = "SELECT * FROM `me_request` WHERE `REQUEST_REFERENCE_UUID` = ? AND `STAFF_ID` = ?";
                                    $stmt = mysqli_stmt_init($db);
                                    if (mysqli_stmt_prepare($stmt,$request)) {
                                      mysqli_stmt_bind_param($stmt,"ss",$slip_row['SLIP_UUID'],$_SESSION['uuid']);
                                      mysqli_stmt_execute($stmt);
                                      mysqli_stmt_store_result($stmt);
                                      $resultCheck = mysqli_stmt_num_rows($stmt);
                                      if ($resultCheck > 0) {
                                        echo "<br><a href='javascript:void(0);' onclick='userViewRequest(this);' data-uuid='$slip_row[SLIP_UUID]' data-toggle='modal' data-target='#view-request'>
                                          <i class='fas fa-sticky-note'></i> View Request
                                        </a>";
                                      }else{
                                        if ($difference->d <= 7) {
                                          echo "<br><a href='javascript:void(0);' onclick='getSlipId(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-toggle='modal' data-target='#generate-request'>
                                            <i class='fas fa-edit'></i> Generate Request
                                          </a>";
                                        }
                                      }
                                    }
                                  }
                                if ($_SESSION['role'] == "admin") { 
                                  // if ($slip_row['SLIP_SUB_TYPE'] != NULL) {
                                    // echo "<br>
                                    // <a href='edit_slip.php?sid=$slip_row[SLIP_UUID]&type=$slip_row[SLIP_TYPE]&subType=$slip_row[SLIP_SUB_TYPE]'>
                                    //   <i class='fas fa-edit'></i> Edit Slip
                                    // </a>";
                                  echo "<br><a href='javascript:void(0);' onclick='editSlip(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-subtype='$slip_row[SLIP_SUB_TYPE]' data-toggle='modal' data-target='#edit-slip'>
                                    <i class='fas fa-edit'></i> Edit Slip
                                  </a><br>
                                  <a onClick='deleteSlip(this)' data-uuid='$slip_row[SLIP_UUID]' href='javascript:void(0);' style='color:red;'>
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