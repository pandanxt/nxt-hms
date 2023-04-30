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
            <a href="javascript:void(0);" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#add-service">
              <i class="fas fa-plus"></i> NEW SERVICE
            </a>
          </div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Service</li>
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
                  <tr style='font-size: 14px;'>
                    <th>Name</th>
                    <th>Charges</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`USER_NAME` FROM `me_general_service` INNER JOIN `me_user` WHERE `me_general_service`.`STAFF_ID` = `me_user`.`USER_UUID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr style='font-size: 12px;'>
                        <td>
                        <label class='switch'>";
                        if ($rs['SERVICE_STATUS'] == 0) {
                          echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$rs['SERVICE_UUID']."' value='".$rs['SERVICE_STATUS']."'>";                          
                        }elseif ($rs['SERVICE_STATUS'] == 1) {
                          echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$rs['SERVICE_UUID']."' value='".$rs['SERVICE_STATUS']."'>";
                        }
                        echo "<span class='slider round'></span>
                        </label>
                        $rs[SERVICE_NAME]</td>
                        <td>$rs[SERVICE_RATE]</td>
                        <td>
                            <b>By</b>: $rs[USER_NAME] <br>
                            <b>On</b>: $rs[SERVICE_DATE_TIME]
                        </td>
                        <td style='display:flex;'>
                            <a href='javascript:void(0);' onclick='getService(this);' data-uuid='$rs[SERVICE_UUID]' data-toggle='modal' data-target='#display-service' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a>
                            <br>
                            <a href='javascript:void(0);' onclick='editService(this);' data-uuid='$rs[SERVICE_UUID]' data-toggle='modal' data-target='#edit-service'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a href='javascript:void(0);' onClick='deleteService(this)' data-uuid='$rs[SERVICE_UUID]' style='color:red;'>
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
    *  Add Service Model Popup Here 
    ** -->
    <div class="modal fade" id="add-service">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="nav-icon fas fa-building"></i> SERVICE</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <span id="err-msg" style="display: none"></span>
          <form action="javascript:void(0)" method="post" id="addService">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name</label>  
                    <input type="text" name="name" class="form-control" id="name" placeholder="Service Name ..." required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Rate</label>  
                    <input type="number" name="rate" class="form-control" id="rate" placeholder="Service Charges ..." required>
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
  <div class="modal fade" id="display-service">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Service</h4>
          <button onclick="autoRefresh()" type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <div class="modal-body" id="viewService">
        </div>
      </div>
    </div>
  </div>

  <!-- **
  *  Update User Model Popup Here 
  ** -->
  <div class="modal fade" id="edit-service">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Service</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <form action='javascript:void(0)' method='post' id='editService'>
          <div class='modal-body' id='editServiceForm'>
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

 <script src="dist/js/service_script.js"></script>
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