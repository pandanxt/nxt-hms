<?php 
  // Session Start
  session_start();
  if (isset($_SESSION['uuid'])) {
  // Connection File
  include('backend_components/connection.php');
  // File Header
  include('components/file_header.php');
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
            <a href="javascript:void(0);" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#add-doctor">
              <i class="fas fa-plus"></i> NEW DOCTOR
            </a>
          </div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Doctors</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Doctor Table Data -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr style='font-size: 14px;'>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`DEPARTMENT_NAME`, `USER_NAME` FROM `me_doctors` INNER JOIN `me_user` INNER JOIN `me_department` WHERE `me_doctors`.`STAFF_ID` = `me_user`.`USER_UUID` AND `me_doctors`.`DOCTOR_DEPARTMENT` = `me_department`.`DEPARTMENT_UUID` AND `me_doctors`.`DOCTOR_TYPE` = 'medeast'";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr style='font-size: 12px;'>
                        <td>
                        <label class='switch'>";
                        if ($rs['DOCTOR_STATUS'] == 0) {
                          echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$rs['DOCTOR_UUID']."' value='".$rs['DOCTOR_STATUS']."'>";                          
                        }elseif ($rs['DOCTOR_STATUS'] == 1) {
                          echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$rs['DOCTOR_UUID']."' value='".$rs['DOCTOR_STATUS']."'>";
                        }
                        echo "<span class='slider round'></span>
                        </label>
                        $rs[DOCTOR_NAME]</td>
                        <td>$rs[DOCTOR_MOBILE]</td>
                        <td>$rs[DEPARTMENT_NAME]</td>
                        <td>
                            <b>By</b>: $rs[USER_NAME] <br>
                            <b>On</b>: $rs[DOCTOR_DATE_TIME]
                        </td>
                        <td style='display:flex;'>
                            <a href='javascript:void(0);' onclick='getDoctor(this);' data-uuid='$rs[DOCTOR_UUID]' data-toggle='modal' data-target='#view-doctor' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a>
                            <br>
                            <a href='javascript:void(0);' onclick='editDoctor(this);' data-uuid='$rs[DOCTOR_UUID]' data-toggle='modal' data-target='#edit-doctor'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a href='javascript:void(0);' onClick='deleteDoctor(this)' data-uuid='$rs[DOCTOR_UUID]' style='color:red;'>
                              <i class='fas fa-trash'></i> Delete
                            </a>
                        </td>
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
  *  Add Doctor Model Popup Here 
  ** -->
  <div class="modal fade" id="add-doctor">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Medeast Doctor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <form action="javascript:void(0)" method="post" id="addDoctor">
        <div class="modal-body">
              <div class="form-group">
                <label>Name</label>  
                <input type="text" name="name" class="form-control" id="name" placeholder="Doctor Name ..." required>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Phone number without '-'" pattern="[0-9]{4}[0-9]{7}" title="Please Enter Phone number with '-'" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Department</label>
                    <select class="form-control select2bs4" name="department" id="department" style="width: 100%;">
                    <option disabled selected>Select Department</option>
                      <?php
                        $dept = 'SELECT `DEPARTMENT_UUID`,`DEPARTMENT_NAME` FROM `me_department` WHERE `DEPARTMENT_STATUS` = 1';
                        $result = mysqli_query($db, $dept) or die (mysqli_error($db));
                          while ($row = mysqli_fetch_array($result)) {
                            $id = $row['DEPARTMENT_UUID'];  
                            $name = $row['DEPARTMENT_NAME'];
                            echo '<option value="'.$id.'">'.$name.'</option>'; 
                        }
                      ?>    
                    </select>
                  </div>
                </div>
              </div>
              <input type="text" name="staffId" id="staffId" value="<?php echo $_SESSION['uuid'] ; ?>" hidden readonly>
              <input type="text" name="uuId" id="uuId" hidden readonly>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- **
  *  View User Model Popup Ends Here 
  ** -->
  <div class="modal fade" id="view-doctor">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Medeast Doctor</h4>
          <button onclick="autoRefresh()" type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <div class="modal-body" id="viewDoctor">
        </div>
      </div>
    </div>
  </div>

  <!-- **
  *  Update User Model Popup Here 
  ** -->
  <div class="modal fade" id="edit-doctor">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Medeast Doctor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <form action='javascript:void(0)' method='post' id='editDoctor'>
          <div class='modal-body' id='editMeForm'>
          </div>
          <div class='modal-footer justify-content-between'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
              <button type='submit' name='submit' class='btn btn-primary'>Save</button>
          </div>
        </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <script src="dist/js/doctor_script.js"></script>
  <!-- /.Footer -->
<?php 
  // Footer File
  include ('components/footer.php'); 
  echo '</div>';
  // REQUIRED SCRIPTS 
  include('components/file_footer.php');
}else{
  echo '<script type="text/javascript">window.location = "login.php";</script>';
} 
?>