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
                              <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?osrId=$slip_row[SLIP_UUID]' style='color:red;'>
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