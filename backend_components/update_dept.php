<?php
    $sql="SELECT * FROM `department` WHERE `DEPARTMENT_ID` = '$_GET[id]' ";
    $qsql = mysqli_query($db,$sql);
    $rsedit = mysqli_fetch_array($qsql);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Department</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Department</li>
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
            <h3 class="card-title"><i class="nav-icon fas fa-building"></i> MedEast Department</h3>

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
                  <label>Department Name</label>
                  <input type="text" name="name" class="form-control" id="inputText1" value="<?php echo $rsedit['DEPARTMENT_NAME']; ?>" required>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <input type="text" name="did" value="<?php echo $rsedit['DEPARTMENT_ID']; ?>" hidden/>
              <!-- <input type="text" name="addDate" id="addDate" hidden/>
              <script>var addDate = new Date();document.getElementById('addDate').value = addDate;</script> -->
               <!-- /.form-group -->
               <!-- <div class="form-group">
                  <label>Department Description</label>
                  <textarea type="text" class="form-control" name="description" id="inputLoginId1" required><?php //echo $rsedit['DEPARTMENT_DESC']; ?></textarea>
                </div> -->
                 <!-- /.form-group -->
                 <div class="form-group">
                  <label>User Status</label>
                  <select class="form-control select2bs4" name="status" style="width: 100%;">
                    <option selected="selected" value="1">Active</option>
                    <option value="0">Unactive</option>
                  </select>
                </div>
                <!-- /.form-group -->
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="text-align: right;">
            <button type="submit"name="update-dept-submit" class="btn btn-block btn-primary">Submit</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  