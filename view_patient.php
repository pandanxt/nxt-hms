<?php 
  // Session Starts
  session_start(); 
  $id = (isset($_GET['id']) ? $_GET['id'] : '');
  // $q = (isset($_GET['q']) ? $_GET['q'] : '');
  if (isset($_SESSION['uuid'])) {
  include('backend_components/connection.php');
  include('components/table_header.php');
  include('components/navbar.php');
  include('components/sidebar.php');

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header"></section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <?php
          $patSql="SELECT `a`.*,`b`.`USER_NAME` FROM `me_patient` AS `a` INNER JOIN `me_user` AS `b` ON `a`.`STAFF_ID` = `b`.`USER_UUID` WHERE `PATIENT_MR_ID` = '$id'";
          
          $qsql = mysqli_query($db,$patSql);
          $row = mysqli_fetch_array($qsql);
          
        ?>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active">
                      <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="fas fa-user"></i>&nbsp;
                            <?php echo $row["PATIENT_NAME"]; ?> Medical History
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
                                  <?php echo '<div class="row"><label>Created By: </label>&nbsp; <p>'.$row["USER_NAME"].'</p></div>'; ?>
                                  
                                  <?php 
                                    if ($_SESSION['role'] == "admin") {
                                      echo '<div class="row"><label>Options: </label>&nbsp; <p>';
                                      echo '<a href="edit_patient.php?id='.$row["PATIENT_MR_ID"].'"><i class="fas fa-edit"></i></a>';
                                      echo '&nbsp; <a href="backend_components/delete_handler.php?prid='.$row["PATIENT_MR_ID"].'" style="color:red;"><i class="fas fa-trash"></i></a>';
                                      echo '</p></div>'; 
                                    }
                                  ?>    
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                                <table id="example1" class="table table-bordered table-striped">
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
                                      $recordQuery ="SELECT `a`.*,`c`.`USER_NAME`,`d`.`DOCTOR_NAME`,`d`.`DOCTOR_TYPE` FROM `me_slip` AS `a` 
                                      INNER JOIN `me_user` AS `c` ON `c`.`USER_UUID` = `a`.`STAFF_ID`
                                      INNER JOIN `me_doctors` AS `d` ON `d`.`DOCTOR_UUID` = `a`.`SLIP_DOCTOR`
                                      WHERE `a`.`SLIP_MRID` = '$id'";
                                      $sql = mysqli_query($db,$recordQuery);
                                      while($slip_row = mysqli_fetch_array($sql))
                                      { 
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
                                              <i class='fas fa-wallet'></i> Print
                                            </a>";
                                            if($slip_row['SLIP_TYPE'] != "OUTDOOR" && $slip_row['SLIP_STATUS'] != 0) {
                                              if($slip_row['SLIP_SUB_TYPE'] != NULL) {
                                                echo "</br>
                                                <a href='bills.php?type=$slip_row[SLIP_TYPE]&subtype=$slip_row[SLIP_SUB_TYPE]&sid=$slip_row[SLIP_UUID]'>
                                                  <i class='fas fa-wallet'></i> Bill
                                                </a>";
                                              }else {
                                                echo "</br>
                                                <a href='bills.php?type=$slip_row[SLIP_TYPE]&sid=$slip_row[SLIP_UUID]'>
                                                  <i class='fas fa-wallet'></i> Bill
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
                                                  echo "<br><a href='javascript:void(0);' onclick='getRequest(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-toggle='modal' data-target='#view-request'>
                                                    <i class='fas fa-sticky-note'></i> Request
                                                  </a>";
                                                }else{
                                                  echo "<br><a href='javascript:void(0);' onclick='getSlipId(this);' data-uuid='$slip_row[SLIP_UUID]' data-type='$slip_row[SLIP_TYPE]' data-toggle='modal' data-target='#generate-request'>
                                                    <i class='fas fa-edit'></i> Generate Request
                                                  </a>";
                                                }
                                              }
                                            }
                                            if ($_SESSION['role'] == "admin") { 
                                            echo "<br>
                                            <a href='add_patient.php?id=$slip_row[SLIP_UUID]'>
                                              <i class='fas fa-edit'></i> Edit
                                            </a><br>
                                            <a onClick='deleteSlip(this)' data-uuid='$slip_row[SLIP_UUID]' href='javascript:void(0);' style='color:red;'>
                                              <i class='fas fa-trash'></i> Delete
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
          </section>
        </div>
  <!-- Javascript Script File -->
  <script src="dist/js/slip_script.js"></script>        
  <!-- /.Footer -->
<?php
  // Footer File
  include_once('components/footer.php');
  echo '</div>';
  // Table Script File
  include('components/table_script.php');

}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>