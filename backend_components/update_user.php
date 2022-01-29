<?php
    $sql="SELECT * FROM `admin` WHERE `ADMIN_ID` ='$_GET[id]' ";
    $qsql = mysqli_query($db,$sql);
    $rsedit = mysqli_fetch_array($qsql);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-users"></i> MedEast User</h3>

            <div class="card-tools">
              <span id='clockDT'></span>
            </div>
          </div>
          <form action="backend_components/update_handler.php" method="post" enctype="multipart/form-data">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" class="form-control" name="name" id="inputText1" value="<?php echo $rsedit['ADMIN_NAME']; ?>" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Login ID</label>
                  <input type="text" class="form-control" name="loginId" id="inputLoginId1" value="<?php echo $rsedit['ADMIN_USERNAME']; ?>" required>
                </div>
                <!-- /.form-group -->
                 <!-- /.form-group -->
                 <div class="form-group">
                  <label>User Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;">
                  <!-- <option disbled value="<?php //echo $rsedit['ADMIN_STATUS']; ?>"><?php //echo $rsedit['ADMIN_STATUS']; ?></option> -->
                    <option selected="selected" value="active">Active</option>
                    <option value="unactive">Unactive</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <!-- <input type="text" name="addDate"  value="<?php //echo $rsedit['ADMIN_SAVE_TIME']; ?>" id="addDate" hidden/>
              <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script> -->
               <input type="text" name="uid" value="<?php echo $rsedit['ADMIN_ID']; ?>" hidden/>
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="email" class="form-control" name="email" id="inputEmail1" value="<?php echo $rsedit['ADMIN_EMAIL']; ?>" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Permissions</label>
                  <select class="form-control select2bs4" name="permission" style="width: 100%;">
                    <!-- <option selected="selected" disbled value="<?php //echo $rsedit['ADMIN_TYPE']; ?>"><?php //echo $rsedit['ADMIN_TYPE']; ?></option> -->
                    <option selected="selected" value="admin">Admin</option>
                    <option value="user">Sub-Admin</option>
                  </select>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit" name="update-user-submit" class="btn btn-block btn-primary">Update</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  