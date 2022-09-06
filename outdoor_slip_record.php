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
    <section class="content-header"></section>
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
                      <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql ="SELECT *,`USER_NAME`,`DEPARTMENT_NAME` FROM `me_outdoor_slip` INNER JOIN `me_user` INNER JOIN `me_department` WHERE `me_outdoor_slip`.`STAFF_ID` = `me_user`.`USER_UUID` AND `me_outdoor_slip`.`SLIP_DEPARTMENT` = `me_department`.`DEPARTMENT_UUID`";
                        $qsql = mysqli_query($db,$sql);
                        while($rs = mysqli_fetch_array($qsql))
                        { 
                        $date = substr($rs['SLIP_DATE_TIME'],0, 21);
                          echo "<tr style='font-size: 12px;'>
                          <td>$rs[SLIP_MR_ID]</td>
                          <td>$rs[SLIP_NAME]</td>
                          <td>$rs[SLIP_MOBILE]</td>
                          <td>$rs[DEPARTMENT_NAME]</td>
                          <td>";
                            $docId = substr($rs['SLIP_DOCTOR'],0, 4);
                            if($docId == 'VTDO') {$docSql ="SELECT `VISITOR_NAME` FROM `vt_doctor` WHERE `VISITOR_UUID` = '$rs[SLIP_DOCTOR]'";}
                            if($docId == 'MEDO') {$docSql ="SELECT `DOCTOR_NAME` FROM `me_doctor` WHERE `DOCTOR_UUID` = '$rs[SLIP_DOCTOR]'";}
                            $dtsql = mysqli_query($db,$docSql);
                            $dt_row = mysqli_fetch_array($dtsql);
                            if($docId == 'MEDO'){
                              echo "$dt_row[DOCTOR_NAME]&nbsp;<button class='btn badge badge-info'>MedEast Doctor</button>";
                            } 
                            if($docId == 'VTDO'){
                              echo "$dt_row[VISITOR_NAME]&nbsp;<button class='btn badge badge-info'>Visiting Doctor</button>";
                            }
                          echo "</td>
                          <td>$rs[SLIP_FEE]</td>
                          <td>
                              <b>By</b>: $rs[USER_NAME] <br>
                              <b>On</b>: $rs[SLIP_DATE_TIME]
                          </td> 
                          <td style='display:flex;'>
                                <a href='javascript:void(0)' onclick='printSlipRecord(this);' data-uuid='$rs[SLIP_UUID]' style='color:green;'>
                                <i class='fas fa-wallet'></i> Print
                              </a>";
                              if ($_SESSION['role'] == "user") {
                                $request = "SELECT * FROM `me_request` WHERE `REQUEST_REFERENCE_UUID` = ? AND `STAFF_ID` = ?";
                                $stmt = mysqli_stmt_init($db);
                                // $t_name = "OPD_SLIP_REQUEST";
                                if (mysqli_stmt_prepare($stmt,$request)) {
                                  mysqli_stmt_bind_param($stmt,"ss",$rs['SLIP_UUID'],$_SESSION['uuid']);
                                  mysqli_stmt_execute($stmt);
                                  mysqli_stmt_store_result($stmt);
                                  $resultCheck = mysqli_stmt_num_rows($stmt);
                                  if ($resultCheck > 0) {
                                    echo "<br><a href='javascript:void(0);' onclick='getRequest(this);' data-uuid='$rs[SLIP_UUID]' data-toggle='modal' data-target='#view-request'>
                                      <i class='fas fa-sticky-note'></i> Request
                                    </a>";
                                  }else{
                                    echo "<br><a href='javascript:void(0);' onclick='getSlipId(this);' data-uuid='$rs[SLIP_UUID]' data-toggle='modal' data-target='#generate-request'>
                                      <i class='fas fa-edit'></i> Generate Request
                                    </a>";
                                  }
                                }
                              }
                              if ($_SESSION['role'] == "admin") { 
                              echo "<br>
                              <a href='add_patient.php?id=$rs[SLIP_UUID]'>
                                <i class='fas fa-edit'></i> Edit
                              </a><br>
                              <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?osrId=$rs[SLIP_UUID]' style='color:red;'>
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
      </section>
  </div>
  <!-- **
  *  Generate Edit Request Model Popup Here 
  ** -->
  <div class="modal fade" id="generate-request">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <form action="javascript:void(0)" method="post" id="ADD_REQUEST">
          <div class="modal-body">
            <div class="form-group">
              <label>Title</label>
              <select class="form-control select2bs4" name="title" id="title" style="width: 100%;">
                <option disabled selected>Select Title</option>
                <option value="cancel">Cancel Slip</option>
                <option value="update">Update Slip</option> 
              </select>
            </div>
            <div class="form-group">
              <label>Comment</label>
              <textarea type="text" name="comment" class="form-control" id="comment" placeholder="Enter Reason of Request ..." required></textarea>
            </div>
            <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
            <input type="text" name="reqId" id="reqId" hidden readonly>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- **
  *  View Request Model Popup Here 
  ** -->
  <div class="modal fade" id="view-request">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="javascript:void(0)" method="post" id="VIEW_REQUEST">
          <div class="modal-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr style="font-size: 14px;">
                <th>Title</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Created</th>
                <th>Option</th>
              </tr>
              </thead>
              <tbody id="body"></tbody>
              </table>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- **
  *  Edit Request Model Popup Here 
  ** -->
  <div class="modal fade" id="edit-request">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-edit"></i> Request</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <form action="javascript:void(0)" method="post" id="EDIT_REQUEST">
        </form>
      </div>
    </div>
  </div>
  <!-- Javascript Script File -->
 <script src="dist/js/opd_script.js"></script>
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