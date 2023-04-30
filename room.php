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
            <a href="javascript:void(0);" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#add-room">
              <i class="fas fa-plus"></i> NEW ROOM
            </a>
          </div>
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rooms</li>
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
                      $sql ="SELECT *,`USER_NAME` FROM `me_room` INNER JOIN `me_user` WHERE `me_room`.`STAFF_ID` = `me_user`.`USER_UUID`";
                      $qsql = mysqli_query($db,$sql);
                      while($rs = mysqli_fetch_array($qsql))
                      { 
                        echo "<tr style='font-size: 12px;'>
                        <td>
                        <label class='switch'>";
                        if ($rs['ROOM_STATUS'] == 0) {
                          echo "<input type='checkbox' onchange='handleStatus(this);' data-uuid='".$rs['ROOM_UUID']."' value='".$rs['ROOM_STATUS']."'>";                          
                        }elseif ($rs['ROOM_STATUS'] == 1) {
                          echo "<input type='checkbox' checked='true' onchange='handleStatus(this);' data-uuid='".$rs['ROOM_UUID']."' value='".$rs['ROOM_STATUS']."'>";
                        }
                        echo "<span class='slider round'></span>
                        </label>
                        $rs[ROOM_NAME]</td>
                        <td>$rs[ROOM_RATE]</td>
                        <td>
                            <b>By</b>: $rs[USER_NAME] <br>
                            <b>On</b>: $rs[ROOM_DATE_TIME]
                        </td>
                        <td style='display:flex;'>
                            <a href='javascript:void(0);' onclick='getRoom(this);' data-uuid='$rs[ROOM_UUID]' data-toggle='modal' data-target='#view-room' style='color:green;'>
                              <i class='fas fa-info-circle'></i> Details
                            </a>
                            <br>
                            <a href='javascript:void(0);' onclick='editRoom(this);' data-uuid='$rs[ROOM_UUID]' data-toggle='modal' data-target='#edit-room'>
                              <i class='fas fa-edit'></i> Edit
                            </a><br>
                            <a href='javascript:void(0);' onClick='deleteRoom(this)' data-uuid='$rs[ROOM_UUID]' style='color:red;'>
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
    *  Add Room Model Popup Here 
    ** -->
    <div class="modal fade" id="add-room">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="nav-icon fas fa-building"></i> ROOM</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <span id="err-msg" style="display: none"></span>
          <form action="javascript:void(0)" method="post" id="addRoom">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name</label>  
                    <input type="text" name="name" class="form-control" id="name" placeholder="Room Name ..." required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Rate</label>  
                    <input type="number" name="rate" class="form-control" id="rate" placeholder="Room Charges ..." required>
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
  <div class="modal fade" id="view-room">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Room</h4>
          <button onclick="autoRefresh()" type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <div class="modal-body" id="viewRoom">
        </div>
      </div>
    </div>
  </div>

  <!-- **
  *  Update User Model Popup Here 
  ** -->
  <div class="modal fade" id="edit-room">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="nav-icon fas fa-user-md"></i> Room</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <span id="err-msg" style="display: none"></span>
        <form action='javascript:void(0)' method='post' id='editRoom'>
          <div class='modal-body' id='editRoomForm'>
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

 <script src="dist/js/room_script.js"></script>
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