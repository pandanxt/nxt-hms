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
            <a href="javascript:void(0);" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#add-dept">
              <i class="fas fa-plus"></i> NEW DEPARTMENT
            </a>
          </div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Departments</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr style='font-size: 14px;'>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql ="SELECT *,`USER_NAME` FROM `me_department` INNER JOIN `me_user` WHERE `me_department`.`STAFF_ID` = `me_user`.`USER_UUID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr style='font-size: 12px;'>
                        <td>
                        <label class='switch'>";
                        if ($rs['DEPARTMENT_STATUS'] == 0) {
                          echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$rs['DEPARTMENT_UUID']."' value='".$rs['DEPARTMENT_STATUS']."'>";                          
                        }elseif ($rs['DEPARTMENT_STATUS'] == 1) {
                          echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$rs['DEPARTMENT_UUID']."' value='".$rs['DEPARTMENT_STATUS']."'>";
                        }
                        echo "<span class='slider round'></span>
                        </label>
                        $rs[DEPARTMENT_NAME]</td>
                        <td>
                            <b>By</b>: $rs[USER_NAME] <br>
                            <b>On</b>: $rs[DEPARTMENT_DATE_TIME]
                        </td>
                        <td style='display:flex;'>
                            <a href='javascript:void(0);' onclick='getDept(this);' data-uuid='$rs[DEPARTMENT_UUID]' data-toggle='modal' data-target='#view-dept' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a>
                            <br>
                            <a href='javascript:void(0);' onclick='editDept(this);' data-uuid='$rs[DEPARTMENT_UUID]' data-toggle='modal' data-target='#edit-dept'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='backend_components/dept_handler.php?q=DELETE_DEPT&id=$rs[DEPARTMENT_UUID]' style='color:red;'>
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
  *  Add Dept Model Popup Here 
  ** -->
  <div class="modal fade" id="add-dept">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Medeast Department</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <form action="javascript:void(0)" method="post" id="addDept">
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Department Name ..." required>
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
  <div class="modal fade" id="view-dept">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Medeast Department</h4>
          <button onclick="autoRefresh()" type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <div class="modal-body" id="viewDept">
        </div>
      </div>
    </div>
  </div>

  <!-- **
  *  Update User Model Popup Here 
  ** -->
  <div class="modal fade" id="edit-dept">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Medeast Department</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <form action='javascript:void(0)' method='post' id='editDept'>
          <div class='modal-body' id='editForm'>
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
 <script src="dist/js/dept_script.js"></script>
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