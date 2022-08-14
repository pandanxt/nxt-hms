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
                    <th>MR-ID </th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Procedure/Surgery</th>
                    <th>Consultant/Surgeon</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`ADMIN_USERNAME` FROM `indoor_slip` INNER JOIN `admin` WHERE `indoor_slip`.`STAFF_ID` = `admin`.`ADMIN_ID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                       $type = $rs['SLIP_TYPE'];
                       $newType;
          
                       if ($type == 'gynae') {
                           $newType = 'Gynae Patient';
                       }else if ($type == 'gensurgery') {
                           $newType = 'General Surgery Patient';
                       }else if ($type == 'genillness') {
                           $newType = 'General Illness Patient';
                       }else if ($type == 'eye') {
                           $newType = 'Eye Patient';
                       }
                       echo "<tr style='font-size: 12px;'>
                       <td>$rs[SLIP_ID]</td>
                        <td>$rs[SLIP_MR_ID]</td>
                        <td>$rs[SLIP_NAME]</td>
                        <td>$rs[SLIP_MOBILE]</td>
                        <td>$rs[SLIP_PROCEDURE]</td>
                        <td>$rs[DOCTOR_NAME]</td>
                        <td>
                            <b>By</b>: $rs[ADMIN_USERNAME] <br>
                            <b>On</b>: $rs[SLIP_DATE_TIME]
                        </td>
                        <td>";
                            if($rs['BILL_STATUS'] == "pending"){
                              echo "<a href='indoor_patient_bill.php?type=".$type."&sid=$rs[SLIP_ID]' style='color:green;'>
                                <i class='fas fa-wallet'></i> Bill
                              </a></br>";
                            } 
                            echo "<a href='javascript:void(0)' onclick='printSlip($rs[SLIP_ID]);' style='color:green;'>
                            <i class='fas fa-wallet'></i> Print
                            </a>";  
                            if ($_SESSION['type'] == "admin") {  
                              echo "</br><a href='add_patient.php?id=$rs[SLIP_ID]'><i class='fas fa-edit'></i> Edit</a>
                              <br>
                              <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/delete_handler.php?isrId=$rs[SLIP_ID]' style='color:red;'>
                              <i class='fas fa-trash'></i> Delete</a>";
                            }
                            if ($_SESSION['type'] == "user") { 
                              $request = "SELECT * FROM `edit_request` WHERE `REQUEST_TABLE_ID` = ? AND `REQUEST_TABLE_NAME` = ? AND `REQUEST_BY` = ?";
                              $stmt = mysqli_stmt_init($db);
                              $t_name = "INDOOR_SLIP_REQUEST";
                              if (mysqli_stmt_prepare($stmt,$request)) {
                                mysqli_stmt_bind_param($stmt,"sss",$rs['SLIP_ID'],$t_name,$_SESSION['userid']);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);
                                $resultCheck = mysqli_stmt_num_rows($stmt);
                                if ($resultCheck > 0) {
                                  echo "</br><a href='javascript:void(0);' onclick='getIndoorRequest($rs[SLIP_ID]);' data-toggle='modal' data-target='#view-request'>
                                    <i class='fas fa-sticky-note'></i> Request
                                  </a>";
                                }else{
                                  echo "</br><a href='javascript:void(0);' onclick='getSlipId($rs[SLIP_ID]);' data-toggle='modal' data-target='#generate-request'>
                                    <i class='fas fa-edit'></i> Generate Request
                                  </a>";
                                }
                              }
                            }
                        echo "</td>
                        </tr>"; 
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
        <form action="javascript:void(0)" method="post" id="GENERATE-INDOOR-SLIP">
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
            <input type="text" name="userId" id="userId" value="<?php echo $_SESSION['userid'] ; ?>" hidden readonly>
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
        <form action="javascript:void(0)" method="post" id="VIEW-INDOOR-SLIP">
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
        <form action="javascript:void(0)" method="post" id="EDIT-INDOOR-SLIP">
        </form>
      </div>
    </div>
  </div>
  <!-- Javascript Script File -->
 <script src="dist/js/indoor_slip_record.js"></script>
  <!-- /.Footer -->
<?php 
  // Footer File
  include ('components/footer.php'); 
  echo '</div>';
  // Table Script File
  include('components/table_script.php'); 

} else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>